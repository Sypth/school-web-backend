<?php

namespace App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LandingPage;

class PartnershipController extends Controller
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
            // validate
            $request->validate([
                'sectionName' => 'required|string|max:100',
                'contents.partnership' => 'required|array',
                'contents.partnership.*' => 'required|string|max:255',
            ]);

            // Create data
            LandingPage::create([
                'section_name' => $request->sectionName,
                'contents' => $request->contents,
            ]);

            return response()->json([
                'message' => 'Partnership section created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create partnership section',
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
            $partnershipSection = LandingPage::latest()->where('section_name', $sectionName)->firstOrFail();

            return response()->json([
                'partnershipSectionData' => $partnershipSection,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch partnership section',
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
