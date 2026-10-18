<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;


//GET routs 
Route::get('/employees/email', [EmployeeController::class, 'showByEmail']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/users',[AuthController::class,'show']);

// POST routs 
Route::post('/employees', [EmployeeController::class, 'store']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);