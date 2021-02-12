<?php

use App\Http\Controllers\ShortenCreateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    /**
     * Routes related to shorten domain
     */
    Route::prefix('shorten')->group(function () {
        // Creates a new shorten url
        Route::post('create', ShortenCreateController::class)->name('shorten.create');
    });
});
