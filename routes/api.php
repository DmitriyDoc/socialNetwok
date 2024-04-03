<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/users',[\App\Http\Controllers\UserController::class,'index']);
    Route::get('/users/{user}/posts',[\App\Http\Controllers\UserController::class,'post']);
    Route::get('/users/{user}/following',[\App\Http\Controllers\UserController::class,'toggleFollowing']);
    Route::get('/users/following_posts',[\App\Http\Controllers\UserController::class,'followingPosts']);

    Route::get('/posts',[\App\Http\Controllers\PostController::class,'index']);
    Route::post('/posts',[\App\Http\Controllers\PostController::class,'store']);
    Route::post('/post_images',[\App\Http\Controllers\PostImageController::class,'store']);
    Route::get('/posts/{post}/liked',[\App\Http\Controllers\PostController::class,'liked']);
    Route::post('/posts/{post}/repost',[\App\Http\Controllers\PostController::class,'repost']);

});


