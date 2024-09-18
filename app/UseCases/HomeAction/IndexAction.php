<?php

namespace App\UseCases\HomeAction;

// モデル紐付け
use App\Models\MSystemFeature;
use App\UseCases\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class IndexAction extends Action
{
    public function __invoke(Request $request, array $attributes = [])
    {
        // ユーザーが所属する企業を取得
        $userCompany = Auth::user()->systemCompanies->first(); // todo: 複数企業に対応

        /**
         * データの新規登録件数を取得
         */

        // 有効な機能を取得
        $enableFeatures = MSystemFeature::enable()->get();

        // 各機能のデータの新規登録件数を取得
        $newRecords = new Collection();
        foreach ($enableFeatures as $enableFeature) {
            try {
                $object = new stdClass;
                $object->key = $enableFeature->key;
                $object->name = __('menu.' . $enableFeature->key);
                $object->count = DB::table($enableFeature->key)
                    ->where('owner_system_company', $userCompany->id)
                    ->whereBetween('created_at', [today()->startOfDay(), now()->endOfDay()])
                    ->count();

                $newRecords->push($object);

            }catch (\Exception $e) {
                Log::error('ホーム画面で新規登録件数の取得に失敗しました。');
                Log::error($e->getMessage());
            }
        }

        return compact('newRecords');
    }
}
