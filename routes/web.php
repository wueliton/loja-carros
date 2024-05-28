<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function Termwind\render;

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
    Route::get('/users', [UserController::class, 'view'])->name('users.view');
});

//Lojas
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/stores', [StoreController::class, 'index'])->name('stores');
    Route::delete('/stores/{id}', [StoreController::class, 'delete'])->name('stores.delete');
});

require __DIR__ . '/auth.php';
