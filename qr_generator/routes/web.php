<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\LocationFeedbackController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

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
                return redirect(route('home'));
            });
    });

Route::middleware(['guest', 'throttle:authorization'])
    ->group(function () {
        Route::get('/', [GuestController::class, 'index'])
            ->name('guest');
        Route::view('/404', 'components.404')
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
