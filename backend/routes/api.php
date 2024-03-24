<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementController;

Route::apiResource('achievements', AchievementController::class);
