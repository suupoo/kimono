<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as GuzzleHttp;

// モデル紐付け
// エクスポートリソース紐付け

class UtilityController extends ResourceController
{
    protected GuzzleHttp $httpClient;

    public function __construct()
    {
        $this->httpClient = new GuzzleHttp();
    }

    public function searchPostCode(Request $request): array
    {
        try {
            $request->validate([
                'post_code' => 'required|digits:7',
            ]);

            $postCode = $request->input('post_code');
            $endpoint = "https://jp-postal-code-api.ttskch.com/api/v1/{$postCode}.json";

            $getRequest = $this->httpClient->request('GET', $endpoint);
            if($getRequest->getStatusCode() !== 200) {
                 throw new \Exception('Failed to get response from jp-postal-code-api.ttskch.com');
            }

            // postal-code-api.ttskch.com からのレスポンス
            $response = json_decode($getRequest->getBody()->getContents());

            // データ整形
            $address = $response->addresses[0];
            $prefectureCode = $address->prefectureCode;
            $address1 = $address->ja->address1;
            $address2 = $address->ja->address2;
            $address3 = $address->ja->address3;
            $address4 = $address->ja->address4;

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
