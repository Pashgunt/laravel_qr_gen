<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\LocationFeedbackController;
use App\Http\Controllers\RegistrationController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::middleware(['location.result'])
    ->group(function () {
        Route::prefix('/location')
            ->name('location.')
            ->group(function () {
                Route::get('/result/{result}/{hash}', [LocationFeedbackController::class, 'resultFeedback'])
                    ->name('result');
            });
    });

Route::middleware(['location.hash'])
    ->group(function () {
        Route::prefix('/location')
            ->name('location.')
            ->group(function () {
                Route::post('/{qr}', [LocationFeedbackController::class, 'store'])
                    ->name('store')
                    ->whereAlphaNumeric('qr');
            });
        Route::resource('/location', LocationFeedbackController::class)
            ->parameters(['location' => 'qr'])
            ->only(['show'])
            ->missing(function () {
                return redirect(route(RouteServiceProvider::HOME));
            });
    });

Route::middleware(['guest', 'throttle:authorization'])
    ->group(function () {
        Route::get('/', [GuestController::class, 'index'])
            ->name(RouteServiceProvider::ROUTE_NAME_GUEST);
        Route::view('/404', 'errors.404')
            ->name('404');
        Route::prefix('/registration')
            ->name('registration.')
            ->group(function () {
                Route::get("/", [RegistrationController::class, 'index'])
                    ->name('index');
                Route::post("/", [RegistrationController::class, 'store'])
                    ->name('store');
            });
    });
