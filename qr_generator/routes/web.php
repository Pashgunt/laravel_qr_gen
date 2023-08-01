<?php

use App\Http\Controllers\FunnelController;
use App\Http\Controllers\LocationFeedback;
use App\Http\Controllers\QrGeneratorController;
use Illuminate\Support\Facades\Route;

Route::resource('/qr', QrGeneratorController::class);

Route::view('/404', 'components.404')->name('404');

Route::middleware(['guest', 'location.hash'])->group(function () {
    Route::prefix('/location')->group(function () {
        Route::post('/{qr}', [LocationFeedback::class, 'store'])->name('location.store');
    });
    Route::resource('/location', LocationFeedback::class)
        ->parameters(['location' => 'qr'])
        ->only(['show']);
});

Route::middleware(['guest'])->group(function () {
    Route::post('/funnel/{company_id}', [FunnelController::class, 'store'])->name('funnel.store');
    Route::resource('/funnel', FunnelController::class)
        ->only(['create']);
});
