<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\CheckAdmin;
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

Route::get('/', function () {
    return view('welcome');
});

Route::name('user.')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('index.login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:10,1')->name('login');
});


Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    // Đảm bảo rằng route này có tên là 'admin.dashboard'
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

