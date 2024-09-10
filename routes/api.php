<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TagController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => ['jwt.auth', IsAdminMiddleware::class]], function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('profiles', ProfileController::class);
Route::apiResource('tags', TagController::class);

Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');


