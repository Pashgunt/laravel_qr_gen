<?php

namespace App\Http\Middleware;

use App\QR\Helpers\Subdomain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordToken
{
    public function handle(Request $request, Closure $next): Response
    {
        return !DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('email', $request->email)
            ->first()
            ? redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')))
            : $next($request);
    }
}
