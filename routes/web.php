<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;


Route::get('/', function () {
    // Check if user is authenticated first
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    } else {
        $posts = [];
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}',[PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}',[PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}',[PostController::class, 'deletePost']);
