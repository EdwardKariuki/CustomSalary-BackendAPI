<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserSalaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('api')->group(function () {
//     // Create or update user salary details
//     Route::post('/user-salary', [UserSalaryController::class, 'storeOrUpdate']);

//     // List all user salary records (for Admin panel)
//     Route::get('/user-salaries', [UserSalaryController::class, 'index']);

//     // Admin can update salary details
//     Route::put('/user-salary/{id}', [UserSalaryController::class, 'update']);
// });

// signup and login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// Get user details
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);
// Logout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
// Create or update user salary details
Route::post('/user-salary', [UserSalaryController::class, 'storeOrUpdate']);
// List all user salary records (for Admin panel)
Route::get('/user-salary', [UserSalaryController::class, 'index']);
// Admin can update salary details
Route::put('/user-salary/{id}', [UserSalaryController::class, 'update']);
