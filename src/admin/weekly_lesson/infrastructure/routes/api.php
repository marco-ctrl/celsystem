<?php

use Illuminate\Support\Facades\Route;
use Src\admin\weekly_lesson\infrastructure\controllers\ListAllLessonGETController;
use Src\admin\weekly_lesson\infrastructure\controllers\StoreLessonPOSTController;

Route::prefix('admin_weekly_lesson')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllLessonGETController::class, 'index']);
        Route::post('/', [StoreLessonPOSTController::class, 'index']);
    });
});