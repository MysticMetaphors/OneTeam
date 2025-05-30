<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('Auth');});

Route::prefix('Task')->group(function () {
    Route::get('/', [TasksController::class, 'index'])->name('task');
    Route::post('/store', [TasksController::class, 'store'])->name('task->store');
    Route::post('/update', [TasksController::class, 'update'])->name('task->update');
});
