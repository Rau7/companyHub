<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// User Routes
Route::apiResource('users', UserController::class);

// Company Routes
Route::get('/companies', [CompanyController::class, 'apiIndex']);
Route::get('/companies/{company}', [CompanyController::class, 'apiShow']);
Route::post('/companies', [CompanyController::class, 'apiStore']);
Route::put('/companies/{company}', [CompanyController::class, 'apiUpdate']);
Route::delete('/companies/{company}', [CompanyController::class, 'apiDestroy']);

// Employee Routes
Route::get('/employees', [EmployeeController::class, 'apiIndex']);
Route::get('/employees/{employee}', [EmployeeController::class, 'apiShow']);
Route::post('/employees', [EmployeeController::class, 'apiStore']);
Route::put('/employees/{employee}', [EmployeeController::class, 'apiUpdate']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'apiDestroy']);
