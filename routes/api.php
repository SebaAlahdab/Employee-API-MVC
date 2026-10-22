
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated users: user and admin
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::get('/employees', [EmployeeController::class, 'index']);

});

// Admin only
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::get('/users', [AuthController::class, 'show']);

});