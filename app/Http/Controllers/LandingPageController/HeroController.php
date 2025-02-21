<?php

namespace App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LandingPage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'sectionName' => 'required|string|max:100',
                'contents' => 'required|array',
                'contents.image' => 'required|string|max:255',
                'contents.title1' => 'required|string|max:150',
                'contents.title2' => 'required|string|max:150',
                'contents.longText' => 'required|string|max:2000',
                'contents.buttonText.primary' => 'required|string|max:50',
                'contents.buttonText.secondary' => 'required|string|max:50',
            ]);

            // Creating data
            LandingPage::create([
                'section_name' => $request->sectionName,
                'contents' => $request->contents,
            ]);

            return response()->json([
                'message' => 'Hero section created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create hero section',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $sectionName)
    {
        try {
            $heroSection = LandingPage::latest()->where('section_name', $sectionName)->firstOrFail();

            return response()->json([
                'heroSectionData' => $heroSection->contents,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch hero section',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
