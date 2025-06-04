<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('Auth');});

Route::prefix('Dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/store', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::post('/update', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::post('/destroy', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

Route::prefix('Task')->group(function () {
    Route::get('/', [TasksController::class, 'index'])->name('task');
    Route::post('/store', [TasksController::class, 'store'])->name('task.store');
    Route::post('/update', [TasksController::class, 'update'])->name('task.update');
    Route::post('/destroy', [TasksController::class, 'destroy'])->name('task.destroy');
});

Route::prefix('Team')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::post('/store', [TasksController::class, 'store'])->name('user.store');
    Route::post('/update', [TasksController::class, 'update'])->name('user.update');
    Route::post('/destroy', [TasksController::class, 'destroy'])->name('user.destroy');
});
