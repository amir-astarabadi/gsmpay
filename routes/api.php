<?php

use App\Http\Controllers\Api\Authentication\LoginController;
use App\Http\Controllers\Api\User\ProfileContoller;
use App\Http\Controllers\Api\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('api.login');


Route::group(['middleware'=> ['auth:api']], function () {
    Route::put('/profiles', [ProfileContoller::class, 'update'])->name('api.profiles.update');
    Route::get('/posts', [PostController::class, 'index'])->name('api.posts.index');
});
