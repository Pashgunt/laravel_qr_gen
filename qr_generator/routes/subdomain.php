<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FeedbackPageSettingsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FunnelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationFeedbackController;
use App\Http\Controllers\NotificationConfigController;
use App\Http\Controllers\QrGeneratorController;
use App\Providers\RouteServiceProvider;

Route::middleware(['guest'])
    ->group(function () {
        Route::prefix('/login')
            ->name('login.')
            ->group(function () {
                Route::get("/", [LoginController::class, 'index'])
                    ->name('index');
                Route::post("/", [LoginController::class, 'store'])
                    ->name('store');
            });
        Route::name('password.')
            ->group(function () {
                Route::prefix('/forgot-password')
                    ->group(function () {
                        Route::get('/', [ForgotPasswordController::class, 'index'])
                            ->name('request');
                        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
                            ->name('email');
                    });
                Route::middleware(['recovery.password'])
                    ->prefix('/reset-password')
                    ->group(function () {
                        Route::get('/{token}', [ForgotPasswordController::class, 'resetPasswordIndex'])
                            ->name('reset')
                            ->whereAlphaNumeric('token');
                        Route::post('/', [ForgotPasswordController::class, 'resetPasswordStore'])
                            ->name('update');
                    });
            });
    });


Route::middleware(['auth', 'throttle:authorization', 'subdomain'])
    ->group(function () {
        Route::prefix('/email')
            ->name('verification.')
            ->group(function () {
                Route::get('/verify', [EmailController::class, 'index'])
                    ->name('notice')
                    ->middleware('verified.result');
                Route::get('/verify/{id}/{hash}', [EmailController::class, 'init'])
                    ->name('verify')
                    ->whereAlphaNumeric('hash');
                Route::post('/verification-notification', [EmailController::class, 'sendNewLink'])
                    ->middleware(['throttle:6,1'])
                    ->name('send');
            });
        Route::get('/logout', [LoginController::class, 'destroy'])
            ->name('login.destroy');
    });


Route::middleware(['auth', 'verified', 'subdomain'])
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])
            ->name(RouteServiceProvider::HOME);

        Route::resource('/qr', QrGeneratorController::class)
            ->parameters(['qr' => 'link_id']);

        Route::prefix('/ajax')
            ->group(function () {
                Route::put('/qr/update', [AjaxController::class, 'updateQr']);
                Route::get('/funnel/{funnel_type_id}', [AjaxController::class, 'funnelOptions'])
                    ->middleware('funnel')
                    ->whereNumber('funnel_type_id');
            });

        Route::prefix('/funnel')
            ->name('funnel.')
            ->group(function () {
                Route::post('/{company_id?}', [FunnelController::class, 'store'])
                    ->name('store');
                Route::delete('/field/{field_id}/delete', [FunnelController::class, 'destroyField'])
                    ->name('destroyField');
                Route::delete('/{funnel_id}/delete', [FunnelController::class, 'destroyFunnel'])
                    ->name('destroyFunnel');
                Route::get('/update/field/{field_id}', [FunnelController::class, 'editField'])
                    ->name('edit.field');
                Route::put('/update/field/{field_id}', [FunnelController::class, 'updateField'])
                    ->name('update.field');
            });

        Route::resource('/funnel', FunnelController::class)
            ->parameters(['funnel' => 'funnel_id'])
            ->only(['create', 'index', 'edit', 'update'])
            ->missing(function () {
                return redirect(route(RouteServiceProvider::HOME));
            });

        Route::resource('/company', CompanyController::class)
            ->parameters(['company' => 'company_id']);

        Route::prefix('/feedback')
            ->name('feedback.')
            ->group(function () {
                Route::get('/', [LocationFeedbackController::class, 'index'])
                    ->name('index');
                Route::delete('/{feedback_id}/delete', [LocationFeedbackController::class, 'destroy'])
                    ->name('destroy')
                    ->whereNumber('id');
            });

        Route::resource('notification-config', NotificationConfigController::class)
            ->parameter('notification-config', 'notification_config:id');

        Route::prefix('/page-settings')
            ->name('page-settings.')
            ->group(function () {
                Route::delete('/link/{link_id}/delete', [FeedbackPageSettingsController::class, 'destroyPageSettingLink'])
                    ->name('destroyLink');
                Route::get('/link/{link_id}/update', [FeedbackPageSettingsController::class, 'editPageSettingLink'])
                    ->name('editLink');
                Route::put('/link/{link_id}/update', [FeedbackPageSettingsController::class, 'updatePageSettingLink'])
                    ->name('updateLink');
            });

        Route::resource('/page-settings', FeedbackPageSettingsController::class)
            ->parameter('page-settings', 'page_setting');

        Route::get('/download/{folder}/{file}', DownloadController::class)
            ->middleware(['throttle:download'])
            ->name('download');
    });
