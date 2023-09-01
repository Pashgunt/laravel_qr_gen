<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Feedback;
use App\Models\QrLink;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {

        Route::model('company_id', Company::class);
        Route::model('feedback_id', Feedback::class);
        Route::model('link_id', QrLink::class);

        Route::pattern('id', '[0-9]+');
        Route::pattern('company_id', '[0-9]+');
        Route::pattern('field_id', '[0-9]+');
        Route::pattern('funnel_id', '[0-9]+');

        $this->configureRateLimiting();

        $this->routes(function () {

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['domain', 'web'])
                ->group(base_path('routes/subdomain.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('domain', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()->id ?: $request->ip())->response(function () {
                return response('Max rate limit', 429);
            });
        });

        RateLimiter::for('authorization', function (Request $request) {
            Limit::perMinute(5)->by($request->ip())->response(function () {
                return response('Max rate limit for auth request', 429);
            });
        });

        RateLimiter::for('download', function (Request $request) {
            Limit::perMinute(5)->by($request->ip())->response(function () {
                return response('Max rate limit for download file request', 429);
            });
        });

        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(1000)->by($request->ip())->response(function () {
                return response('max request rate limit', 429);
            });
        });
    }
}
