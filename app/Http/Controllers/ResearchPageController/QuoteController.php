<?php

namespace App\Http\Controllers\ResearchPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ResearchPage;

class QuoteController extends Controller
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
        try {
            // Validation
            $request->validate([
                'sectionName' => 'required|string',
                'contents' => 'required|array',
                'contents.quote' => 'required|string|max:500',
                'contents.by' => 'required|string|max:100',
            ]);

            // Creating data
            ResearchPage::create([
                'section_name' => $request->sectionName,
                'contents' => $request->contents,
            ]);

            return response()->json([
                'message' => 'Quote section created successfully.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create quote section.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch quote section',
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
            $quoteSection = ResearchPage::latest()->where('section_name', $sectionName)->firstOrFail();

            return response()->json([
                'quoteSectionData' => $quoteSection,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch quote section',
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
