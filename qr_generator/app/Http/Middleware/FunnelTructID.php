<?php

namespace App\Http\Middleware;

use App\Filters\FunnelTypeFilter;
use App\Models\FunnelTypes;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FunnelTructID
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $funnelType = FunnelTypes::filter(new FunnelTypeFilter($request))
            ->first();
        if (!$funnelType) return response('ok', 204);
        return $next($request);
    }
}
