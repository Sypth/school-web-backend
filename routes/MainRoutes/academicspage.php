<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AcademicsPageController\HeroController,
    App\Http\Controllers\AcademicsPageController\QuoteController,
    App\Http\Controllers\AcademicsPageController\ElementaryController,
    App\Http\Controllers\AcademicsPageController\JuniorHighController,
    App\Http\Controllers\AcademicsPageController\SeniorHighController,
    App\Http\Controllers\AcademicsPageController\UndergraduateController,
    App\Http\Controllers\AcademicsPageController\GraduateController;

Route::prefix('academics')->group(function () {

    // Public Routes
    Route::get('hero/{sectionName}', [HeroController::class, 'show']);
    Route::get('quote/{sectionName}', [QuoteController::class, 'show']);
    Route::get('elementary/{sectionName}', [ElementaryController::class, 'show']);
    Route::get('junior-high/{sectionName}', [JuniorHighController::class, 'show']);
    Route::get('senior-high/{sectionName}', [SeniorHighController::class, 'show']);
    Route::get('undergraduate/{sectionName}', [UndergraduateController::class, 'show']);
    Route::get('graduate/{sectionName}', [GraduateController::class, 'show']);


    // Authenticated Routes
    Route::middleware('auth:sanctum')->group(function () {
        // Hero routes
        Route::apiResource('hero', HeroController::class)->except(['show', 'index']);

        // Quote routes
        Route::apiResource('quote', QuoteController::class)->except(['show', 'index']);

        // Elementary routes
        Route::apiResource('elementary', ElementaryController::class)->except(['show', 'index']);

        // Junior High routes
        Route::apiResource('junior-high', JuniorHighController::class)->except(['show', 'index']);

        // Senior High routes
        Route::apiResource('senior-high', SeniorHighController::class)->except(['show', 'index']);

        // Undergraduate routes
        Route::apiResource('undergraduate', UndergraduateController::class)->except(['show', 'index']);

        // Graduate routes
        Route::apiResource('graduate', GraduateController::class)->except(['show', 'index']);
    });
});