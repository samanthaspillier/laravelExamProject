<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;




Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::get('/about', function(){
    return view('content.about');
})->name('about');

Route::get('/post/{post}', [PostController::class, 'displayPost'])->name('post.show');
Route::get('/faq', [FaqController::class, 'showFAQ'])->name('faq');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::post('/comments', [CommentController::class, 'storeComment'])->name('comments.store');
    
    // Admin-specific routes
    Route::middleware(['admin'])->group(function () {
        Route::put('/users/{id}/role', [AdminController::class, 'updateRole'])->name('UpdateRole');
        Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('adminCreate');
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admindashboard');
        Route::get('/admin/edit/{faq}', [AdminController::class, 'editFaq'])->name('editFaq');
        Route::put('/admin/{faq}', [AdminController::class, 'updateFaq'])->name('updateFaq');
    });

   
});

require __DIR__.'/auth.php';

Auth::routes();




