<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/site/loja', function () {
    return view('lojas');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Usuários
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'list'])->name('users');
    Route::get('/users/create', [UserController::class, 'createView']);
    Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete')->where('id', '[0-9]+');
    Route::get('/users/{id}', [UserController::class, 'getUser'])->name('users.get')->where('id', '[0-9]+');
    Route::patch('users/{id}', [UserController::class, 'edit'])->name('users.edit')->where('id', '[0-9]+');

    Route::get('/users/list', [UserController::class, 'get'])->name('users.list');
});

//Lojas
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/stores', [StoreController::class, 'index'])->name('stores');
    Route::inertia('/stores/create', 'Stores/Create');
    Route::get('/stores/{id}', [StoreController::class, 'getStore'])->name('stores.get')->where('id', '[0-9]+');
    Route::post('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::delete('/stores/{id}', [StoreController::class, 'delete'])->name('stores.delete')->where('id', '[0-9]+');
    Route::post('/stores/{id}', [StoreController::class, 'edit'])->name('stores.edit')->where('id', '[0-9]+');
});

Route::get('/files/{fileName}', [ImageController::class, 'getImage'])->where('fileName', '.*');

require __DIR__ . '/auth.php';
