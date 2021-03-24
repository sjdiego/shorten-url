<?php

use App\Http\Controllers\Backend\{
    LoginController,
    BackendController,
    ShortenListController,
    ShortenUpdatePageController,
    ShortenUpdateActionController,
    ShortenDeletePageController,
    ShortenDeleteActionController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Home page
 */
Route::get('/', fn () => view('home'))->name('home');

/**
 * Requested shortened URL
 */
Route::get('/{slug}', fn($slug) => view('check', ['code' => $slug]))
    ->where('slug', '^[A-Za-z]{5}')
    ->name('check');

/**
 * Backend routes
 */
Route::prefix('backend')->group(function () {
    Route::middleware(['auth'])->group(function () {
        // Main page
        Route::get('/', [BackendController::class, 'render'])->name('dashboard');

        // Shortens management
        Route::prefix('shortens')->group(function() {
            Route::get('/', ShortenListController::class)->name('shorten.list');
            Route::get('update/{id}', ShortenUpdatePageController::class)->name('shorten.update');
            Route::post('update/{id}', ShortenUpdateActionController::class);
            Route::get('delete/{id}', ShortenDeletePageController::class)->name('shorten.delete');
            Route::delete('delete/{id}', ShortenDeleteActionController::class);
        });

        // Logout
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });

    // Login
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'render'])->name('login');
        Route::post('auth', [LoginController::class, 'auth'])->name('auth');
    });
});

/**
 * Other non-existant pages
 */
Route::fallback(fn () => view('404'));
