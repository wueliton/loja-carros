<?php

use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiMotorcycleController;
use App\Http\Controllers\Api\ApiQuickSearchParams;
use App\Http\Controllers\Api\ApiStoresController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/api'], function () {
    Route::group(['prefix' => '/cars'], function () {
        Route::get('/highlights', [ApiCarController::class, 'highlights']);
        Route::get('/brand-models', [ApiCarController::class, 'getBrandModels']);
        Route::get('{slug}', [ApiCarController::class, 'getBySlug']);
        Route::get('', [ApiCarController::class, 'find']);
    });

    Route::group(['prefix' => '/motorcycles'], function () {
        Route::get('/brand-models', [ApiMotorcycleController::class, 'getBrandModels']);
        Route::get('', [ApiMotorcycleController::class, 'find']);
        Route::get('{slug}', [ApiMotorcycleController::class, 'getBySlug']);
    });

    Route::group(['prefix' => '/search'], function () {
        Route::get('/quick/options', [ApiQuickSearchParams::class, 'quickSearchOptions']);
    });

    Route::group(['prefix' => 'stores'], function () {
        Route::get('{slug}', [ApiStoresController::class, 'getBySlug']);
        Route::get('/ads/{id}', [ApiStoresController::class, 'getAds']);
        Route::get('', [ApiStoresController::class, 'find']);
    });
});
