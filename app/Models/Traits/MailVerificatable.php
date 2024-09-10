<?php

namespace App\Models\Traits;

use App\Models\SystemEmailVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * メールによる認証を行うためのトレイト
 */
trait MailVerificatable
{
    /**
     *
     * メール認証トークンを生成して登録する
     * @return SystemEmailVerification|false
     */
    public function registerEmailVerification(): SystemEmailVerification|false
    {
        try{
            // メール認証レコードを登録
            $now = Carbon::now();
            $expired = $now->copy()->addMinutes(60 * 12); // 12時間後
            $attributes = [
                'model'         => get_class($this),
                'models_id'     => $this->id,
                'email'         => $this->email,
                'token'         => bin2hex(random_bytes(32)),
                'created_at'    => $now,
                'expired_at'    => $expired,
            ];

            return
                SystemEmailVerification::create($attributes);

        }catch (\Exception $exception){
            Log::error('メール認証レコードの登録に失敗しました。');
            return false;
        }
    }
}
