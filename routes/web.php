<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShortenListController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    // Login
    Route::get('login', [LoginController::class, 'render'])->name('login');

    // Main dashboard: list shortens
    Route::get('/', [ShortenListController::class, 'list'])
        ->middleware(['auth'])
        ->name('backend.list');
});

/**
 * Other non-existant pages
 */
Route::fallback(fn () => view('404'));
