<?php

namespace App\Http\Controllers\AcademicsPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcademicsPage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // Validation
            $request->validate([
                'sectionName' => 'required|string|max:100',
                'contents' => 'required|array',
                'contents.title' => 'required|string|max:150',
                'contents.longText' => 'required|string|max:2000',
                'contents.buttonText' => 'required|string|max:100',
            ]);

            // Creating data
            AcademicsPage::create([
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
        try{
            $heroSection = AcademicsPage::latest()->where('section_name', $sectionName)->firstOrFail();

            return response()->json([
                'heroSectionData' => $heroSection,
            ], 200);
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
