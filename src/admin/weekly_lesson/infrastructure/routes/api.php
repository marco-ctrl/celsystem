<?php

use Illuminate\Support\Facades\Route;
use Src\admin\weekly_lesson\infrastructure\controllers\ListAllLessonGETController;

Route::prefix('admin_weekly_lesson')->group(function () {
    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/', [ListAllLessonGETController::class, 'index']);
    });
});