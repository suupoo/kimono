<?php

namespace App\UseCases\MeAction;

// モデル紐付け
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ListAction
{
    public function __invoke(Request $request, string $model, array $attributes = [])
    {
        try {
            $loginUser = Auth::user();

            return $loginUser;

        } catch (\Exception $e) {
            // 例外処理
            Log::error(('error:'.__METHOD__), ['message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
        }
    }
}
