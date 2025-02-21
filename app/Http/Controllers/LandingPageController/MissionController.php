<?php

namespace App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class MissionController extends Controller
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
        try{
            // Validation
            $request->validate([
                'sectionName' => 'required|string|max:100',
                'contents' => 'required|array',
                'contents.title' => 'required|string|max:150',
                'contents.longText' => 'required|string|max:2000',
                // 'contents.carousel' => 'required|array',
                // 'contents.carousel.title' => 'nullable|string|max:150',
                // 'contents.carousel.slides' => 'required|array',
                // 'contents.carousel.slides.*.image' => 'required|string|max:255',
                // 'contents.carousel.slides.*.text' => 'required|string|max:150',
            ]);

            // Creating data
            LandingPage::create([
                'section_name' => $request->sectionName,
                'contents' => $request->contents,
            ]);
            
            return response()->json([
                'message' => 'Mission section created successfully',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create mission section',
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
        $missionSection = LandingPage::latest()->where('section_name', $sectionName)->firstOrFail();
        
        // Generate an ETag based on the data
        $etag = md5(json_encode($missionSection->contents));

        // Check if the client's ETag matches the server's ETag
        if (request()->header('If-None-Match') === $etag) {
            return response()->noContent(304); // 304 Not Modified
        }

        // Return the data with ETag and Cache-Control headers
        return response()->json([
            'missionSectionData' => $missionSection->contents ?? [],
        ])->setEtag($etag)
          ->header('Cache-Control', 'public, max-age=300'); // Cache for 5 minutes
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to fetch mission section',
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
