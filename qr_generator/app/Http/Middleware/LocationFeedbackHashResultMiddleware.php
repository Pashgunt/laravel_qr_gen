<?php

namespace App\Http\Middleware;

use App\Filters\FeedbackFilterResultFilter;
use App\Models\FeedbackFilter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationFeedbackHashResultMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $result = FeedbackFilter::filter(new FeedbackFilterResultFilter($request))->first();
        if (!$result) return redirect(route('guest'));
        return $next($request);
    }
}
