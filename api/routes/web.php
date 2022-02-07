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

Route::get(
    'medias/{filename}',
    'GetFile'
)->where('filename', '[A-Za-z0-9\/.\(\)-_]*');

Route::get(
    'storage/{filename}',
    'GetFile'
)->where('filename', '[A-Za-z0-9\/.\(\)-_]*');

Route::get('robots.txt', 'RobotsController');

Route::fallback('Api\GetFallbackAction')
    ->name('web.fallback');
