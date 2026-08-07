<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TrackerController;
use App\Http\Controllers\Api\WorkoutController;
use App\Http\Controllers\Api\WorkoutLogController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'store']);

    Route::get('/exercises', [ExerciseController::class, 'index']);
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);

    Route::get('/workout-assignments', [WorkoutController::class, 'assignments']);
    Route::post('/workout-assignments', [WorkoutController::class, 'assign']);
    Route::post('/workout-generate', [WorkoutController::class, 'generate']);

    Route::get('/workout-logs', [WorkoutLogController::class, 'index']);
    Route::post('/workout-logs', [WorkoutLogController::class, 'store']);
    Route::get('/personal-records', [WorkoutLogController::class, 'records']);

    Route::get('/tracker/water', [TrackerController::class, 'water']);
    Route::post('/tracker/water/add', [TrackerController::class, 'addWater']);
    Route::post('/tracker/water/reset', [TrackerController::class, 'resetWater']);
    Route::get('/tracker/weight', [TrackerController::class, 'weightEntries']);
    Route::post('/tracker/weight', [TrackerController::class, 'logWeight']);
    Route::get('/tracker/measurements', [TrackerController::class, 'measurements']);
    Route::post('/tracker/measurements', [TrackerController::class, 'logMeasurement']);
});
