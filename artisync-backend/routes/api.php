<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MachineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('machines', MachineController::class);
    Route::post('/machines/{machine}/maintenances', [App\Http\Controllers\MaintenanceController::class, 'store']);
});
