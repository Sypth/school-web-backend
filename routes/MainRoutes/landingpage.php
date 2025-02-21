<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController\LandingPageController,
    App\Http\Controllers\LandingPageController\HeroController,
    App\Http\Controllers\LandingPageController\MissionController,
    App\Http\Controllers\LandingPageController\ResearchController,
    App\Http\Controllers\LandingPageController\TestimonialController,
    App\Http\Controllers\LandingPageController\ScholarshipController,
    App\Http\Controllers\LandingPageController\NewsController,
    App\Http\Controllers\LandingPageController\CommunityWorksController,
    App\Http\Controllers\LandingPageController\AdmissionController,
    App\Http\Controllers\LandingPageController\PartnershipController;



Route::prefix('landing')->group(function () {

    // Public Routes
    Route::get('/', [LandingPageController::class, 'index']);
    Route::get('hero/{sectionName}', [HeroController::class, 'show']);
    Route::get('mission/{sectionName}', [MissionController::class, 'show']);
    Route::get('research/{sectionName}', [ResearchController::class, 'show']);
    Route::get('testimonial/{sectionName}', [TestimonialController::class, 'show']);
    Route::get('scholarship/{sectionName}', [ScholarshipController::class, 'show']);
    Route::get('news/{sectionName}', [NewsController::class, 'show']);
    Route::get('community-works/{sectionName}', [CommunityWorksController::class, 'show']);
    Route::get('admission/{sectionName}', [AdmissionController::class, 'show']);
    Route::get('partnership/{sectionName}', [PartnershipController::class, 'show']);

    // Authenticated Routes
    Route::middleware('auth:sanctum')->group(function () {
        // Hero routes
        Route::apiResource('hero', HeroController::class)->except(['show', 'index']);

        // Mission routes
        Route::apiResource('mission', MissionController::class)->except(['show', 'index']);

        // Research routes
        Route::apiResource('research', ResearchController::class)->except(['show', 'index']);

        // Testimonial routes
        Route::apiResource('testimonial', TestimonialController::class)->except(['show', 'index']);

        // Scholarship routes
        Route::apiResource('scholarship', ScholarshipController::class)->except(['show', 'index']);

        // News routes
        Route::apiResource('news', NewsController::class)->except(['show', 'index']);

        // Community Works routes
        Route::apiResource('community-works', CommunityWorksController::class)->except(['show', 'index']);

        // Admission routes
        Route::apiResource('admission', AdmissionController::class)->except(['show', 'index']);

        // Partnership routes
        Route::apiResource('partnership', PartnershipController::class)->except(['show', 'index']);
    });

    
});