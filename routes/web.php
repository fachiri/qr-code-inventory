<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubItemController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->middleware([])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('master')->name('master.')->middleware([])->group(function () {
        Route::resource('/unit', UnitController::class)->names('unit');
        Route::resource('/category', CategoryController::class)->names('category');
        Route::resource('/item', ItemController::class)->names('item');
        Route::get('/item/{uuid}/print', [ItemController::class, 'print'])->name('item.print');
        Route::resource('/subitem', SubItemController::class)->names('subitem');
    });
});
Route::name('public.')->group(function () {
    Route::get('/item/{uuid}/{no}', [ItemController::class, 'detail'])->name('item.detail');
});

