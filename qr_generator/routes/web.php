<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FunnelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationFeedbackController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QrGeneratorController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::view('/404', 'components.404')->name('404');

Route::middleware(['location.hash'])->group(function () {
    Route::prefix('/location')->group(function () {
        Route::post('/{qr}', [LocationFeedbackController::class, 'store'])->name('location.store');
    });
    Route::resource('/location', LocationFeedbackController::class)
        ->parameters(['location' => 'qr'])
        ->only(['show']);
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('/registration')->group(function () {
        Route::get("/", [RegistrationController::class, 'index'])
            ->name('registration');
        Route::post("/", [RegistrationController::class, 'store'])
            ->name('registration.store');
    });
    Route::prefix('/login')->group(function () {
        Route::get("/", [LoginController::class, 'index'])
            ->name('login');
        Route::post("/", [LoginController::class, 'store'])
            ->name('login.store');
    });
    Route::prefix('/forgot-password')->group(function () {
        Route::get('/', [ForgotPasswordController::class, 'index'])
            ->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
            ->name('password.email');
    });
    Route::prefix('/reset-password')->group(function () {
        Route::get('/{token}', [ForgotPasswordController::class, 'resetPasswordIndex'])
            ->name('password.reset');
        Route::post('/', [ForgotPasswordController::class, 'resetPasswordStore'])
            ->name('password.update');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/email')->group(function () {
        Route::get('/verify', [EmailController::class, 'index'])
            ->name('verification.notice');
        Route::get('/verify/{id}/{hash}', [EmailController::class, 'init'])
            ->middleware(['signed'])
            ->name('verification.verify');
        Route::post('/verification-notification', [EmailController::class, 'sendNewLink'])
            ->middleware(['throttle:6,1'])
            ->name('verification.send');
    });
    Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::resource('/qr', QrGeneratorController::class)
        ->parameters(['qr' => 'link_id']);

    Route::prefix('/ajax')->group(function () {
        Route::put('/qr/update', [AjaxController::class, 'updateQr']);
        Route::get('/funnel/{funnel_type_id}', [AjaxController::class, 'funnelOptions'])
            ->middleware('funnel');
    });

    Route::post('/funnel/{company_id?}', [FunnelController::class, 'store'])
        ->name('funnel.store');
    Route::delete('/funnel/field/{field_id}/delete', [FunnelController::class, 'destroyField'])
        ->name('funnel.destroyField');
    Route::delete('/funnel/{funnel_id}/delete', [FunnelController::class, 'destroyFunnel'])
        ->name('funnel.destroyFunnel');
    Route::resource('/funnel', FunnelController::class)
        ->parameters(['funnel' => 'funnel_id'])
        ->only(['create', 'index', 'edit', 'update']);

    Route::resource('/company', CompanyController::class)
        ->parameters(['company' => 'company_id']);

    Route::prefix('/feedback')->group(function () {
        Route::get('/', [LocationFeedbackController::class, 'index'])
            ->name('feedback.index');
        Route::delete('/{id}/delete', [LocationFeedbackController::class, 'destroy'])
            ->name('feedback.destroy');
    });

    Route::get('/download/{folder}/{file}', DownloadController::class)->name('download');
});
