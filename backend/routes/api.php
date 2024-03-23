<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('achievements', AchievementController::class);
});
