<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChallengeRecordController;
use App\Http\Controllers\UserAchievementController;
use App\Http\Middleware\Authenticate;

Route::middleware([Authenticate::class])->group(function () {
    Route::apiResource('achievement', AchievementController::class);

    Route::get('user', [UserController::class, 'index'])->name('allUsers');
    Route::get('user/{user_id}', [UserController::class, 'show'])->name('singleUser');
    Route::put('user/{user_id}', [UserController::class, 'update'])->name('updateUser');
    Route::delete('user/{user_id}', [UserController::class, 'destroy'])->name('deleteUser');

    Route::post('challenge-record', [ChallengeRecordController::class, 'createOrUpdate'])->name('createOrUpdateChallengeRecord');
    Route::delete('challenge-record/{challengeRecord_id}', [ChallengeRecordController::class, 'destroy'])->name('deleteChallengeRecord');

    Route::get('rank-list/{challenge_number}', [ChallengeRecordController::class, 'rankList'])->name('singleChallengeRecord');
    Route::get('rank-list/rank/user', [UserController::class, 'getChallengeRecords'])->name('userRank');

    Route::post('user-achievement', [UserAchievementController::class, 'store'])->name('storeUserAchievement');
    Route::get('user-achievement', [UserController::class, 'completeAchievement'])->name('UserCompleteAchievement');
    Route::delete('user-achievement/{user_achievement_id}', [UserAchievementController::class, 'destroy'])->name('deleteUserAchievement');

    Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('auth/refresh', [AuthController::class, 'refresh'])->name('refresh');
});


Route::post('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
