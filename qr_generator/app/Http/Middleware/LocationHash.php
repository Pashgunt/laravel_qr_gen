<?php

namespace App\Http\Middleware;

use App\Filters\CompanyHashFilter;
use App\Models\CompanyTableHash;
use App\Providers\RouteServiceProvider;
use App\Qr\Helpers\Subdomain;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationHash
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        list($qr) = array_values($request->route()->parameters());
        if (!$qr) return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')));
        $res = CompanyTableHash::filter(new CompanyHashFilter($request))->first();
        if (!$res) return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')));
        $subdomain = Subdomain::getSubdomain($request->getHost());
        if ($subdomain !== sprintf('%s.%s', RouteServiceProvider::SUBDOMAIN_LOCATION_FEEDBACK, env('APP_URL')))
            return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL')));
        return $next($request);
    }
}
