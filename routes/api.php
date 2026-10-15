<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user(); 
     });

Route::get('/employees/email', [EmployeeController::class, 'showByEmail']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
