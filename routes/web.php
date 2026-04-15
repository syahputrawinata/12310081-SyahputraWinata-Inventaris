<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\UserController;

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

Route::middleware(['guest'])->group(function() {
    Route::get('/', function () {
        return view('landing');
    });
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginStore', [AuthController::class, 'loginStore'])->name('loginStore');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware('CheckRole:admin')->group(function() {
        Route::get('categories/export', [CategoryController::class, 'exportExcel'])->name('categories.export');
        Route::resource('categories', CategoryController::class);
        Route::get('items/{id}/lendings', [ItemController::class, 'showLending'])->name('items.lendings');
        Route::get('items/export', [ItemController::class, 'exportExcel'])->name('items.export');
        Route::resource('items', ItemController::class);
    });
        
    Route::get('users/export', [UserController::class, 'exportExcel'])->name('users.export');
    Route::resource('users', UserController::class);

    Route::resource('lendings', LendingController::class);
    Route::patch('lendings/{lending}/return', [LendingController::class, 'returnITem'])->name('lendings.return');
});