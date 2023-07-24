<?php

namespace App\Providers;

use App\QR\Contracts\Feedback;
use App\QR\Services\LocationFeedback;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Feedback::class, function () {
            return new LocationFeedback();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
