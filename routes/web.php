<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', static function () {
    return view('main');
});

Route::get('/', [PlayerController::class, 'index'])->name('index');
Route::get('/player-register-form', [PlayerController::class, 'playerRegisterForm'])->name('player-register-form');
Route::post('/player-create', [PlayerController::class, 'playerCreate'])->name('player-create');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('customer-create', [PlayerController::class, 'store'])->name('customer.create');
