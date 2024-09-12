<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// モデル紐付け
// エクスポートリソース紐付け

class UtilityController extends ResourceController
{
    public function searchPostCode(Request $request): array
    {
        try {
            $request->validate([
                'post_code' => 'required|digits:7',
            ]);

            $postCode = $request->input('post_code');
            $endpoint = "https://jp-postal-code-api.ttskch.com/api/v1/{$postCode}.json";

            $response = Http::get($endpoint);

            // postal-code-api.ttskch.com からのレスポンス
            $prefectureCode = $response->json('addresses.0.prefectureCode');
            $prefecture = $response->json('addresses.0.prefectureCode');
            $address1 = $response->json('addresses.0.ja.address1');
            $address2 = $response->json('addresses.0.ja.address2');
            $address3 = $response->json('addresses.0.ja.address3');
            $address4 = $response->json('addresses.0.ja.address4');

            return [
                'status' => 200,
                'data' =>  [
                    'prefecture' => $prefectureCode,
                    'address_1' => $address1 . $address2 . $address3,
                    'address_2' => $address4,
                ],
            ];

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [
                'status' => 400,
                'data' => [],
            ];
        }
    }
}
