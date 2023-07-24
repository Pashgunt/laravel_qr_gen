<?php

namespace App\Http\Middleware;

use App\QR\Repositories\CompanyTableHashRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationHash
{
    public function handle(Request $request, Closure $next): Response
    {
        list($qr) = array_values($request->route()->parameters());
        if (!$qr) return redirect(route('404'));
        $res = (new CompanyTableHashRepository())->checkIssetHashString($qr);
        if (!$res) return redirect(route('404'));
        return $next($request);
    }
}
