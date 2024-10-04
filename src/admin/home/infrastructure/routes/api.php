<?php

// use Src\admin\home\infrastructure\controllers\ExampleGETController;

use Illuminate\Support\Facades\Route;
use Src\admin\home\infrastructure\controllers\DataCardGETController;

Route::prefix('admin_home')->group(function () {
//     // Simple route example
 Route::get('/card', [DataCardGETController::class, 'index']);

//     // Authenticated route example
//     // Route::middleware(['auth:sanctum'])->get('/', [ExampleGETController::class, 'index']);

//     // Group example for Authenticated routes
// Route::group([
//     //     'middleware' => 'auth:sanctum',
//     // ], function () {
//     //     Route::get('/', [ExampleGETController::class, 'index']);
//     //     // add as many authenticated routes as necessary
//     // });
});