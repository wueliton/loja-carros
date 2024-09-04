<?php

use App\Http\Controllers\Admin\AdminStoreController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::group(['prefix' => 'store'], function () {
        Route::get('', [AdminStoreController::class, 'edit'])->name('store');
        Route::post('', [AdminStoreController::class, 'update'])->name('store.update');
    });
});
