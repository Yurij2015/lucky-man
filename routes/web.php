<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\Admin\PlayerController as AdminPlayerController;
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
Route::post('/', [PlayerController::class, 'playerGame'])->name('main');
Route::post('/new-link-generate', [PlayerController::class, 'newLinkGenerate'])->name('new-link-generate');
Route::put('/destroy-link', [PlayerController::class, 'destroyLink'])->name('destroy-link');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('admin/add-player-form', [AdminPlayerController::class, 'addPlayerForm'])->name('add-player-form');
    Route::get('admin/update-player-form/{player}', [AdminPlayerController::class, 'updatePlayerForm'])
        ->name('update-player-form');
    Route::delete('admin/player-destroy/{player}', [AdminPlayerController::class, 'destroyPlayer'])
        ->name('player-destroy');
    Route::get('admin/player-show/{player}', [AdminPlayerController::class, 'showPlayer'])->name('player-show');
    Route::put('admin/player-update/{player}', [AdminPlayerController::class, 'updatePlayer'])->name('player-update');
    Route::post('admin/player-create', [AdminPlayerController::class, 'playerCreate'])->name('admin-player-create');


})->middleware('auth');
