<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\ContributeController;
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
})->name('home');

Route::name('user.')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('index.login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:10,1')->name('login');
    Route::get('/contribute',[ContributeController::class,'index'])->name('get.contribute');
    Route::post('/contribute',[ContributeController::class,'postContribute'])->name('post.contribute');
});


Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('store.user');
    Route::put('/update-user/{id}', [AdminController::class, 'updateUser'])->name('update.user'); // Sử dụng PUT ở đây
    Route::delete('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete.user');
});

