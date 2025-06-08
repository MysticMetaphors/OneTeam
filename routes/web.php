<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth');
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::middleware('auth')->group(function () {
    Route::prefix('Dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
        Route::post('/store', [DashboardController::class, 'store'])->name('dashboard.store');
        Route::post('/update', [DashboardController::class, 'update'])->name('dashboard.update');
        Route::post('/destroy', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    });

    Route::prefix('Project')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('project');
        Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
        Route::get('/show/{id}', [ProjectController::class, 'show'])->name('project.show');
        Route::post('/store', [ProjectController::class, 'store'])->name('project.store');
        Route::post('/update', [ProjectController::class, 'update'])->name('project.update');
        Route::post('/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
    });

    Route::prefix('Task')->group(function () {
        Route::get('/', [TasksController::class, 'index'])->name('task');
        Route::get('/create', [TasksController::class, 'create'])->name('task.create');
        Route::post('/store', [TasksController::class, 'store'])->name('task.store');
        Route::post('/update', [TasksController::class, 'update'])->name('task.update');
        Route::post('/destroy', [TasksController::class, 'destroy'])->name('task.destroy');
    });

    Route::prefix('Team')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/update', [UserController::class, 'update'])->name('user.update');
        Route::post('/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    });
});
