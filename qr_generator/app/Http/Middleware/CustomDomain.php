<?php

namespace App\Http\Middleware;

use App\Qr\Helpers\Subdomain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomDomain
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $subdomain = Subdomain::getSubdomain($request->getHost());

        $res = Auth::guard('subdomain')->validateEmail([
            'subdomain' => $subdomain,
        ]);

        if (!$res) return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')));

        $request->merge([
            'subdomain' => $subdomain,
            'subdomain_auth' => Auth::guard('subdomain')
                ->subdomain(),
        ]);

        return $next($request);
    }
}
