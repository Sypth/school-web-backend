<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;

// Public Route
Route::prefix('test')->group(function () {
    Route::get('/public', [TestController::class, 'index']);
    Route::get('/permitted', [TestController::class, 'permitted'])->middleware('auth:sanctum')->middleware('role:admin');
});