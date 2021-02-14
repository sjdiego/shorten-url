<?php

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
Route::get('/{slug}', fn() => view('check'))->name('check');

/**
 * Other non-existant pages
 */
Route::fallback(fn () => view('404'));
