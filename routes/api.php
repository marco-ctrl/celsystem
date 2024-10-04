<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'loginUser']);

Route::group(['middleware' => 'auth:sanctum',], function () {
    Route::get('/logout', [AuthController::class, 'logoutUser']);
    Route::get('/check-token', [AuthController::class, 'checkToken']);
});
