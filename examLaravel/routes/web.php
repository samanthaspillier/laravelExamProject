<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
    return view('content.about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin-specific routes
    Route::middleware('admin')->group(function () {
        Route::put('/users/{id}/role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
        Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    });
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function(){
    return view('content.about');
})->name('about');
