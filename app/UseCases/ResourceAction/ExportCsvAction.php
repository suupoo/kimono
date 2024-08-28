<?php

namespace App\UseCases\ResourceAction;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SplFileObject;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * CSVエクスポートアクション
 */
class ExportCsvAction extends ResourceAction
{
    protected string $exportResourceClass;

    /**
     * エクスポートリソースクラス紐付け
     * @param string $exportResourceClass
     * @return void
     */
    public function setExportResourceClass(string $exportResourceClass): void
    {
        $this->exportResourceClass = $exportResourceClass;
    }

    /**
     * Handle the incoming request.
     *
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, string $model): RedirectResponse|StreamedResponse
    {
        // セッショントークンの再生成（二重送信対策）
        $this->updateCsrfToken();

        // アクション開始時の処理
        $this->startOfAction($request, $model);

        // リソースに紐づいたモデルインスタンスを生成
        $model = new $model;

        // バリデーションルールの生成
        $rules = [];
        $columns = $model->getColumns();
        $attributeNames = [];
        foreach ($columns as $column) {
            if($column->column() === 'id') {
                $rules['exports'] = ['required', 'array'];
                $rules['exports.*'] = $column->rules();
                $attributeNames['exports'] = '出力対象';
                $attributeNames['exports.*'] =  '出力対象ID';
            }
        }

        // バリデーション実行前の処理
        $this->beforeOfValidate($request, $model, [
            'rules' => &$rules,
            'columns' => &$columns,
        ]);

        // バリデーション
        $validator = Validator::make($request->all(), $rules)
            // バリデーション実行時の項目名はVOのlabelを参照
            ->setAttributeNames($attributeNames);

        // バリデーション実行後の処理
        $this->afterOfValidate($request, $model, [
            'validator' => &$validator,
            'columns' => &$columns,
        ]);

        // ルーティング名のプレフィックスを取得
        $routePrefix = $this->prefix ?? $model->getTable();

        try {
            // バリデーションエラー時はcatchから返す
            if ($validator->fails()) {
                throw new \Exception('不正な入力値が存在しています。');
            }

            // 検索条件を設定する
            $query = $model->query()->whereIn('id', $request->exports)
                ->orderBy('owner_sequence_no');

            // 検索実行前の処理
            $this->beforeOfSearch($request, $model, [
                'query' => &$query,
            ]);

            // 検索実行
            $searchCollection = $query->get();

            // 検索実行後の処理
            $this->beforeOfSearch($request, $model, [
                'searchCollection' => &$searchCollection,
            ]);

            if($searchCollection->isEmpty()) {
                throw new \Exception('出力対象が存在しませんでした。');
            }

            // エクスポート前の処理
            $this->beforeOfExport($request, $model, [
                'attributes' => &$attributes,
            ]);

            // エクスポート処理
            $timestamp = Carbon::now()->format('YmdHis');
            $name = $model::NAME;
            $title = "{$timestamp}_{$name}";
            $fileName = "$title.pdf";

            // データ行の生成
            $records = [];

            // ヘッダー
            $emptyResource = new $this->exportResourceClass(new $model);
            $records[] = $emptyResource->csvHeadersNames();
            // データ
            $searchCollection->each(function ($item) use (&$records){
                $resource = new $this->exportResourceClass($item);
                $records[] = $resource->toArray(request());
            });

            // エクスポート後の処理
            $this->formattingOfExport($request, $model, [
                'attributes' => &$attributes,
            ]);

            // アクション終了時の処理
            $this->endOfAction($request, $model);

            // ダウンロード
            return response()->stream(function() use ($records) {
                // 出力処理
                $createCsvFile = new SplFileObject('php://output', 'w');

                // まとめて出力
                foreach ($records as $record) {
                    $createCsvFile->fputcsv($record);
                    flush();
                }
            }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename={$fileName}",
            ]);

        } catch (\Exception $e) {
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);

            // エラー時は入力画面へ入力値を返して戻る
            return redirect()->route($routePrefix.'.index')->withInput()
                ->withErrors(['error' => __('Error of Export')]);
        }
    }
}
