<?php

namespace App\Http\Middleware;

use App\Filters\CompanyHashFilter;
use App\Models\CompanyTableHash;
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
        if (!$qr) return redirect(route('404'));
        $res = CompanyTableHash::filter(new CompanyHashFilter($request))->first();
        if (!$res) return redirect(route('404'));
        return $next($request);
    }
}
