<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::get('/about', function(){
    return view('content.about');
})->name('about');

Route::get('/showPost/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('content.showPost');

Route::get('/dashboard', function () {
    return view('profile.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::get('/newComment/{post}', [CommentController::class, 'newComment'])->name('comment.new');
    
    // Admin-specific routes
    Route::middleware('admin')->group(function () {
        Route::put('/users/{id}/role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
        Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');
        Route::get('/admin', [AdminController::class, 'admin.dashboard'])->name('admin.dashboard');
    });
});

require __DIR__.'/auth.php';

Auth::routes();




