<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubItemController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});
Route::name('auth.')->middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login_index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login_process'])->name('login.process');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('/user', UserController::class)->names('user');
    Route::prefix('master')->name('master.')->middleware([])->group(function () {
        Route::resource('/unit', UnitController::class)->names('unit');
        Route::resource('/category', CategoryController::class)->names('category');
        Route::resource('/item', ItemController::class)->names('item');
        Route::get('/item/{uuid}/print', [ItemController::class, 'print'])->name('item.print');
        Route::get('/subitem/{uuid}/create', [SubItemController::class, 'create'])->name('subitem.create');
        Route::get('/subitem/{uuid}/edit', [SubItemController::class, 'edit'])->name('subitem.edit');
        Route::post('/subitem/{uuid}/store', [SubItemController::class, 'store'])->name('subitem.store');
        Route::put('/subitem/{uuid}/update', [SubItemController::class, 'update'])->name('subitem.update');
        Route::delete('/subitem/{uuid}/destroy', [SubItemController::class, 'destroy'])->name('subitem.destroy');
    });
    Route::post('/logout', [AuthController::class, 'logout_process'])->name('logout.process');
});
Route::name('public.')->group(function () {
    Route::get('/item/{uuid}/{no}', [ItemController::class, 'detail'])->name('item.detail');
});
