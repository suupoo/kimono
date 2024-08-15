<?php

namespace App\UseCases\MeAction;

use App\Facades\Utility\CustomStorage;
use App\Mail\User\VerifyEmailFromSystem;
use App\UseCases\Action;
use App\ValueObjects\Master\Administrator\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/**
 * Class SaveAction
 * 保存アクション
 */
class SaveAction extends Action
{
    /**
     * Handle the incoming request.
     *
     * @return RedirectResponse|void
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model)
    {
        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        // リソースに紐づいたモデル
        $model = new $model;

        // バリデーションルールの生成
        $rules = [];
        $columns = $model->getColumns();
        $attributeNames = [];
        foreach ($columns as $column) {
            $rules[$column->id()] = $column->rules();
            $attributeNames[$column->id()] = $column->label();
        }

        // バリデーション
        $validator = Validator::make($request->all(), $rules)
            // バリデーション実行時の項目名はVOのlabelを参照
            ->setAttributeNames($attributeNames);

        // バリデーションエラー
        if ($validator->fails()) {
            $redirectRouteName = Route::currentRouteName();

            // バリデーションエラー時は入力画面へ入力値を返して戻る
            return redirect()->route($redirectRouteName)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $updateEntity = Auth::user();

            $attributes = [];
            foreach ($columns as $column) {
                if (array_key_exists($column->id(), $validator->validated())) {
                    $attributes[$column->column()] = $validator->validated()[$column->id()];
                }
            }

            // パスワードが空の場合は削除
            if (! $attributes['password']) {
                unset($attributes['password']);
            }
            // ファイルがある場合はアップロード
            if (array_key_exists('image', $attributes)) {
                $image = new Image;
                $extension = $request->file('image')->getClientOriginalExtension();
                $uploadPath = CustomStorage::disk()
                    ->putFileAs($image->fileUploadPath(), $request->file('image'), $image->createFileName($extension));
                if ($uploadPath) {
                    $attributes['image'] = $uploadPath;
                }
            }

            // 更新
            $updateEntity->fill($attributes);
            if ($updateEntity->isDirty()) {

                // トランザクションで処理する
                DB::beginTransaction();

                $updateEntity->save();

                // コミット
                DB::commit();

                // コミット後の処理でメール送信
                $this->afterOfCommit($request, $model, [
                    'attributes' => &$attributes,
                    'entity' => &$updateEntity,
                ]);
            }

            // 閲覧画面に戻す処理
            return redirect()->route(Route::currentRouteName());

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            return redirect()->route(Route::currentRouteName())->withInput()
                ->withErrors(['error' => __('Error of General')]);
        }
    }

    /**
     * コミット後の処理
     */
    public function afterOfCommit(Request $request, string $model, array $attributes = []): void
    {
        try {
            $entity = $attributes['entity'];
            // メールアドレスが変更されている場合は認証メールを送信する
            if ($entity->wasChanged('email')) {
                $email = $entity->email;
                Mail::to($email)->send(new VerifyEmailFromSystem());
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
