<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// routes/api.php

Route::post('login',   [AuthController::class, 'login']);
Route::post('register',   [AuthController::class, 'register']);
Route::post('logout',  [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('me',       [AuthController::class, 'me'])->middleware('auth:api');
