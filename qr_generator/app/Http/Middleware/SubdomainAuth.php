<?php

namespace App\Http\Middleware;

use App\QR\Helpers\Subdomain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubdomainAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user();

        if (!$user) return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')));

        $subdomain = Subdomain::getSubdomain($request->getHost());

        $result = Auth::guard('subdomain')->validate([
            'subdomain' => $subdomain,
            'email' => $user->email,
        ]);

        if (!$result) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')));
        }

        $request->merge([
            'subdomain' => $subdomain,
            'subdomain_auth' => Auth::guard('subdomain')
                ->subdomain(),
        ]);

        return $next($request);
    }
}
