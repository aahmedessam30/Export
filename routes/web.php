<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('search', [HomeController::class, 'search'])->name('search');

    Route::resource('user', UserController::class)->except(['index', 'show']);

    Route::get('pdf', [HomeController::class, 'exportToPDF'])->name('pdf');

    Route::get('excel', [HomeController::class, 'exportToEXCEL'])->name('excel');
});

Route::get('/', function () {
    return view('welcome');
});
