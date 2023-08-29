<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\SubdomainAuth;
use App\QR\Services\Guards\SubdomainGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::provider('subdomain', function () {
            return new SubdomainAuthProvider(new SubdomainAuth());
        });

        Auth::extend('subdomain', function () {
            return new SubdomainGuard(
                app(SubdomainAuthProvider::class),
                app(Request::class)
            );
        });
    }
}
