<?php

use App\Http\Controllers\LocationFeedback;
use App\Http\Controllers\QrGeneratorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/qr', QrGeneratorController::class);

Route::view('/404', 'components.404')->name('404');

Route::prefix('/location')->middleware(['guest', 'location.hash'])->group(function () {
    Route::resource('{qr}', LocationFeedback::class)
        ->only(['index', 'store'])
        ->missing(function () {
            return route('location');
        });
})->name('location');
