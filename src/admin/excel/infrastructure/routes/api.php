<?php

use Illuminate\Support\Facades\Route;
use Src\admin\excel\infrastructure\controllers\ReportExportController;

Route::prefix('admin_excel')->group(function () {
//     // Simple route example
Route::get('/informe-export', [ReportExportController::class, 'exportXLS']);

//     // Authenticated route example
//     // Route::middleware(['auth:sanctum'])->get('/', [ExampleGETController::class, 'index']);

//     // Group example for Authenticated routes
//     // Route::group([
//     //     'middleware' => 'auth:sanctum',
//     // ], function () {
//     //     Route::get('/', [ExampleGETController::class, 'index']);
//     //     // add as many authenticated routes as necessary
//     // });
});