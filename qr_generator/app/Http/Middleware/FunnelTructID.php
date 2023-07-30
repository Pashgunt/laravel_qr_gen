<?php

namespace App\Http\Middleware;

use App\Models\FunnelTypes;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FunnelTructID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route()->parameter('id');
        if (!FunnelTypes::find($id)->first()) return response('ok', 204);
        return $next($request);
    }
}
