<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\QR\Helpers\Subdomain;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedResult
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->email_verified_at?->toDateString())
            return redirect(route(RouteServiceProvider::HOME));
        return $next($request);
    }
}
