<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResearchPageController\HeroController,
    App\Http\Controllers\ResearchPageController\QuoteController,
    App\Http\Controllers\ResearchPageController\CassedResearchController,
    App\Http\Controllers\ResearchPageController\CcisResearchController,
    App\Http\Controllers\ResearchPageController\ChtmResearchController,
    App\Http\Controllers\ResearchPageController\CobResearchController;

Route::prefix('research')->group(function () {
    //Public routes
    Route::get('/hero/{sectionName}', [HeroController::class, 'show']);
    Route::get('/quote/{sectionName}', [QuoteController::class, 'show']);
    Route::get('/cassed-research/{sectionName}', [CassedResearchController::class, 'show']);
    Route::get('/ccis-research/{sectionName}', [CcisResearchController::class, 'show']);
    Route::get('/chtm-research/{sectionName}', [ChtmResearchController::class, 'show']);
    Route::get('/cob-research/{sectionName}', [CobResearchController::class, 'show']);

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        // Hero section
        Route::apiResource('hero', HeroController::class)->except(['show', 'index']);

        // Quote section
        Route::apiResource('quote', QuoteController::class)->except(['show', 'index']);

        // Cassed research section
        Route::apiResource('cassed-research', CassedResearchController::class)->except(['show', 'index']);

        // Ccis research section
        Route::apiResource('ccis-research', CcisResearchController::class)->except(['show', 'index']);

        // Chtm research section
        Route::apiResource('chtm-research', ChtmResearchController::class)->except(['show', 'index']);

        // Cob research section
        Route::apiResource('cob-research', CobResearchController::class)->except(['show', 'index']);
    });
});