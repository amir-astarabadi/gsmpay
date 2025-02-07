<?php

use App\Http\Controllers\Api\Authentication\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('api.login');
