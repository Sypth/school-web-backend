<?php

namespace App\Http\Controllers\AcademicsPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcademicsPage;

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
        try{
            // Validation
            $request->validate([
                'sectionName' => 'required|string|max:100',
                'contents' => 'required|array',
                'contents.quote' => 'required|string|max:2000',
                'contents.by' => 'required|string|max:100',
            ]);

            // Creating data
            AcademicsPage::create([
                'section_name' => $request->sectionName,
                'contents' => $request->contents,
            ]);

            return response()->json([
                'message' => 'Quote section created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create quote section',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $quoteSection = AcademicsPage::latest()->where('id', $id)->firstOrFail();

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
