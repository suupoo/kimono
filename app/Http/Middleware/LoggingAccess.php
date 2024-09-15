<?php

namespace App\Http\Middleware;

use App\Models\SystemLoggingAccessIpAddress;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoggingAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // アクセスログを記録
        $this->accessLog();

        if(Auth::check()){
            // ログイン中の場合はアクセスしたデバイスを記録
            $systemLoggingAccessIpAddress = SystemLoggingAccessIpAddress::firstOrCreate([
                'm_system_administrator_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // すでに作成済みで更新する場合
            if(!$systemLoggingAccessIpAddress->wasRecentlyCreated){
                $systemLoggingAccessIpAddress->touch();
            }
        }
        return $next($request);
    }

    private function accessLog():void
    {
        // 暫定でアクセスログを設置
        \Illuminate\Support\Facades\Log::info('Access', [
            \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            [
                'user_id' => auth()?->id(),
                'ip' => request()->ip(),
                'host' => request()->getHost(),
                'method' => request()->method(),
                'url' => request()->url(),
                'referer' => request()->header('referer') ?? 'none',
                'parameters' => request()->except('password', 'password_confirmation'),
                'user_agent' => request()->userAgent(),
            ],
        ]);
    }
}
