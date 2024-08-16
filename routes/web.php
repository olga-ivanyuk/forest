<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

//Route::resource('posts', PostController::class);
//Route::get('/posts', [PostController::class, 'index']);
//Route::get('/posts/{post}/show', [PostController::class, 'show']);
//Route::get('/posts/store', [PostController::class, 'store']);
//Route::get('/posts/{post}/update', [PostController::class, 'update']);
//Route::get('/posts/{post}/destroy', [PostController::class, 'destroy']);
//Route::resource('categories', CategoryController::class);
//Route::get('/categories', [CategoryController::class, 'index']);
//Route::get('/categories/{category}/show', [CategoryController::class, 'show']);
//Route::get('/categories/store', [CategoryController::class, 'store']);
//Route::get('/categories/{category}/update', [CategoryController::class, 'update']);
//Route::get('/categories/{category}/destroy', [CategoryController::class, 'destroy']);
//Route::resource('comments', CommentController::class);
//Route::get('/comments', [CommentController::class, 'index']);
//Route::get('/comments/{comment}/show', [CommentController::class, 'show']);
//Route::get('/comments/store', [CommentController::class, 'store']);
//Route::get('/comments/{comment}/update', [CommentController::class, 'update']);
//Route::get('/comments/{comment}/destroy', [CommentController::class, 'destroy']);
//Route::resource('profile', ProfileController::class);
//Route::get('/profiles', [ProfileController::class, 'index']);
//Route::get('/profiles/{profile}/show', [ProfileController::class, 'show']);
//Route::get('/profiles/store', [ProfileController::class, 'store']);
//Route::get('/profiles/{profile}/update', [ProfileController::class, 'update']);
//Route::get('/profiles/{profile}/destroy', [ProfileController::class, 'destroy']);
//Route::resource('tags', TagController::class);
//Route::get('/tags', [TagController::class, 'index']);
//Route::get('/tags/{tag}/show', [TagController::class, 'show']);
//Route::get('/tags/store', [TagController::class, 'store']);
//Route::get('/tags/{tag}/update', [TagController::class, 'update']);
//Route::get('/tags/{tag}/destroy', [TagController::class, 'destroy']);

