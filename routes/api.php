<?php

use App\Http\Controllers\Api\Authentication\LoginController;
use App\Http\Controllers\Api\User\ProfileContoller;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('api.login');

Route::group(['middleware'=> ['auth:api']], function () {
    Route::put('/profiles', [ProfileContoller::class, 'update'])->name('api.profiles.update');
});
