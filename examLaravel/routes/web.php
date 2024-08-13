<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoriesController;
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
    Route::post('/passwordUpdate', [PasswordController::class, 'updatePassword'])->name('passwordUpdate');
    Route::get('/profile/delete/{user}', [ProfileController::class, 'destroy'])->name('profile.delete');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::post('/comments', [CommentController::class, 'storeComment'])->name('comments.store');
    
    // Admin-specific routes
    Route::middleware(['admin'])->group(function (){
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        Route::get('admin/newUser', [AdminController::class, 'newUser'])->name('newUser');
        Route::post('/admin/users', [AdminController::class, 'createUser'])->name('admin.users.store');
        Route::get('/admin/users/search', [AdminController::class, 'searchUsers'])->name('admin.users.search');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');

        Route::get('/admin/message/{message}/answer', [AdminController::class, 'answerMessageForm'])->name('answerMessage');
        Route::post('/admin/contact-message/{message}/answer', [AdminController::class, 'submitAnswer'])->name('submitAnswer');



        Route::get('/admin/faq/create', [FaqController::class, 'createFaq'])->name('createFaq');
        Route::post('/admin/faq', [FaqController::class, 'storeFaq'])->name('storeFaq');
        Route::get('/admin/edit/{faq}', [FaqController::class, 'editFaq'])->name('editFaq');
        Route::put('/admin/{faq}', [FaqController::class, 'updateFaq'])->name('updateFaq');
        Route::get('/faq/delete/{faq}', [FaqController::class, 'deleteFaq'])->name('deleteFaq');

        Route::get('/admin/categories', [FaqCategoriesController::class, 'index'])->name('admin.categories');
        Route::get('/admin/categories/create', [FaqCategoriesController::class, 'create'])->name('createCategory');
        Route::post('/admin/categories', [FaqCategoriesController::class, 'store'])->name('storeCategory');
        Route::get('/admin/categories/{category}/edit', [FaqCategoriesController::class, 'edit'])->name('editCategory');
        Route::put('/admin/categories/{category}', [FaqCategoriesController::class, 'update'])->name('updateCategory');
        Route::get('/admin/categories/delete/{category}', [FaqCategoriesController::class, 'destroy'])->name('deleteCategory');
        
        Route::get('/admin/post/create', [PostController::class, 'createPost'])->name('createPost');
        Route::post('/admin/post', [PostController::class, 'storePost'])->name('storePost');
        Route::get('/admin/post/{post}/edit', [PostController::class, 'editPost'])->name('editPost');
        Route::put('/admin/post/{post}', [PostController::class, 'updatePost'])->name('updatePost');
        Route::get('/posts/delete/{post}', [PostController::class, 'deletePost'])->name('deletePost');

         });

   
});


require __DIR__.'/auth.php';

Auth::routes();





