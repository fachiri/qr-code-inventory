<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComponentController;
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
    Route::middleware(['roles:ADMIN'])->group(function () {
        Route::resource('/user', UserController::class)->names('user');
        Route::patch('/user/{uuid}/update-account', [UserController::class, 'update_account'])->name('user.update.account');
        Route::patch('/user/{uuid}/update-password', [UserController::class, 'update_password'])->name('user.update.password');
    });
    Route::prefix('master')->name('master.')->middleware(['roles:ADMIN'])->group(function () {
        Route::resource('/unit', UnitController::class)->names('unit');
        Route::resource('/category', CategoryController::class)->names('category');
        Route::resource('/item', ItemController::class)->names('item');
        Route::get('/item/{uuid}/print', [ItemController::class, 'print'])->name('item.print');
        Route::resource('/subitem', SubItemController::class)->names('subitem');
        Route::get('/subitem/{uuid}/print', [SubItemController::class, 'print'])->name('subitem.print');
        Route::resource('/component', ComponentController::class)->names('component');
        Route::patch('/component/{id}/subitem', [ComponentController::class, 'update_component_subitem'])->name('component.update.subitem');
    });
    Route::post('/subitem/{uuid}/borrow', [SubItemController::class, 'borrow'])->name('subitem.borrow');
    Route::resource('/borrow', BorrowController::class)->names('borrow');
    Route::get('/logout', [AuthController::class, 'logout_process'])->name('logout.process');
});
Route::name('public.')->group(function () {
    Route::get('/barang/{uuid}', [SubItemController::class, 'detail'])->name('subitem.detail');
});
