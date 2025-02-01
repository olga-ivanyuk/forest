<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');
Route::get('/posts', [HomeController::class, 'index'])->name('posts.index');

Route::middleware('auth')->group(function () {
    Route::get('posts/{post}', [HomeController::class, 'show'])->name('posts.show');
    Route::post('posts/{post}/comments/{comment}/child', [HomeController::class, 'storeChildComment'])->name('posts.comments.child.store');
    Route::post('posts/{post}/comments', [HomeController::class, 'storeComment'])->name('posts.comments.store');
    Route::post('posts/{post}/toggle-likes', [HomeController::class, 'toggleLike'])->name('posts.likes.toggle');
    Route::post('posts/{post}/{comment}/toggle-comment-likes', [CommentController::class, 'commentToggleLike'])->name('posts.comment.likes.toggle');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
