<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// API Routes
Route::apiResource('users', UserController::class);
