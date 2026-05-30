<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/machines', [MachineController::class, 'index']); 

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('machines', MachineController::class)->except(['index']);
    Route::get('/machines/{machine}/maintenances', [MaintenanceController::class, 'index']);
    Route::post('/machines/{machine}/maintenances', [MaintenanceController::class, 'store']);
    Route::get('/dashboard', App\Http\Controllers\DashboardController::class);
});
