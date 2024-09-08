<?php

namespace App\Http\Middleware;

use App\UseCases\AuthAction\LogoutAction;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasPrivilegeOfLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if( $user->end_at !== null && $user->end_at < Carbon::now()){
            // ログアウト
            return (new LogoutAction)($request, [
                'error' => "利用終了日を超えたためログアウトされました。再度利用する場合はお問い合わせください。"
            ]);
        }

        return $next($request);
    }
}
