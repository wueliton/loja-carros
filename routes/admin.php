<?php

use App\Http\Controllers\Admin\AdminStoreController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
        Route::get('', [AdminStoreController::class, 'edit'])->name('edit');
        Route::post('', [AdminStoreController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('', [AdminUserController::class, 'list'])->name('list');
        Route::get('create', [AdminUserController::class, 'new'])->name('new');
        Route::get('{id}', [AdminUserController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
        Route::patch('{id}', [AdminUserController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::post('', [AdminUserController::class, 'create'])->name('create');
        Route::delete('{id}', [AdminUserController::class, 'create'])->name('delete')->where('id', '[0-9]+');
    });
});
