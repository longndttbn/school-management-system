<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Manage User All Router
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'view'])->name('user.view');
    Route::get('/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

// Profile Manage All Router
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'viewPassword'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
});