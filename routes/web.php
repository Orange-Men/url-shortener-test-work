<?php

use App\Http\Controllers\ShortLinkController;
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

Route::get('/', function () {
    return redirect()->route('shortener.index');
});

Route::prefix('url-shortener')->name('shortener.')->group(function () {
    Route::get('/', [ShortLinkController::class, 'index'])->name('index');
    Route::post('/', [ShortLinkController::class, 'store'])->name('store');

    Route::get('/{code}', [ShortLinkController::class, 'link'])->name('link');
});
