<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;




Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::get('/about', function(){
    return view('content.about');
})->name('about');

Route::get('/post/{post}', [PostController::class, 'displayPost'])->name('post.show');
Route::get('/faq', [FaqController::class, 'showFAQ'])->name('faq');
Route::get('/contact', [ContactMessageController::class, 'showForm'])->name('contactForm');
Route::post('/contact', [ContactMessageController::class, 'submitForm'])->name('contact.submit');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/delete/{user}', [ProfileController::class, 'destroy'])->name('profile.delete');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::post('/comments', [CommentController::class, 'storeComment'])->name('comments.store');
    
    // Admin-specific routes
    Route::middleware(['admin'])->group(function (){
        Route::post('/admin/users', [AdminController::class, 'createUser'])->name('admin.users.store');
        Route::get('admin/newUser', [AdminController::class, 'newUser'])->name('newUser');
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::get('/admin/users/search', [AdminController::class, 'searchUsers'])->name('admin.users.search');
        Route::get('/admin/message/{message}/answer', [AdminController::class, 'answerMessageForm'])->name('answerMessage');
        Route::post('/admin/contact-message/{message}/answer', [AdminController::class, 'submitAnswer'])->name('submitAnswer');



        Route::get('/admin/faq/create', [AdminController::class, 'createFaq'])->name('createFaq');
        Route::post('/admin/faq', [AdminController::class, 'storeFaq'])->name('storeFaq');
        Route::get('/admin/edit/{faq}', [AdminController::class, 'editFaq'])->name('editFaq');
        Route::put('/admin/{faq}', [AdminController::class, 'updateFaq'])->name('updateFaq');
        Route::get('/faq/delete/{faq}', [AdminController::class, 'deleteFaq'])->name('deleteFaq');


        
        Route::get('/admin/post/create', [AdminController::class, 'createPost'])->name('createPost');
        Route::post('/admin/post', [AdminController::class, 'storePost'])->name('storePost');
        Route::get('/admin/post/{post}/edit', [AdminController::class, 'editPost'])->name('editPost');
        Route::put('/admin/post/{post}', [AdminController::class, 'updatePost'])->name('updatePost');
        Route::get('/posts/delete/{post}', [AdminController::class, 'deletePost'])->name('deletePost');

         });

   
});


require __DIR__.'/auth.php';

Auth::routes();





