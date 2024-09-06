<?php

use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiMotorcycleController;
use App\Http\Controllers\Api\ApiQuickSearchParams;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/api'], function () {
    Route::group(['prefix' => '/cars'], function () {
        Route::get('/highlights', [ApiCarController::class, 'highlights']);
        Route::get('/brand-models', [ApiCarController::class, 'getBrandModels']);
        Route::get('{id}', [ApiCarController::class, 'getById']);
    });

    Route::group(['prefix' => '/motorcycles'], function () {
        Route::get('/brand-models', [ApiMotorcycleController::class, 'getBrandModels']);
    });

    Route::group(['prefix' => '/search'], function () {
        Route::get('/quick/options', [ApiQuickSearchParams::class, 'quickSearchOptions']);
    });
});
