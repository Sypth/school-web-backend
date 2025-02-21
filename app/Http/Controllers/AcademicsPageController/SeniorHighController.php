<?php

namespace App\Http\Controllers\AcademicsPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AcademicsPage;

class SeniorHighController extends Controller
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
                'contents.subtitle' => 'required|array',
                'contents.subtitle.line1' => 'required|string|max:150',
                'contents.subtitle.line2' => 'required|string|max:150',
                'contents.posts' => 'required|array',
                'contents.posts.*.image' => 'required|string|max:200',
                'contents.posts.*.imageFirst' => 'required|boolean',
                'contents.posts.*.title' => 'required|string|max:150',
                'contents.posts.*.content' => 'required|string|max:2000',
                'contents.posts.*.buttonText' => 'required|string|max:100',
                'contents.carousel' => 'required|array',
                'contents.carousel.slides.*.image' => 'required|string|max:200',
                'contents.carousel.slides.*.text' => 'required|string|max:150',
            ]);

            // Creating data
            AcademicsPage::create([
                'section_name' => $request->sectionName,
                'contents' => $request->contents,
            ]);

            return response()->json([
                'message' => 'Senior high section created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create senior high section',
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
            $seniorHighSection = AcademicsPage::latest()->where('section_name', $sectionName)->firstOrFail();

            return response()->json([
                'seniorHighSectionData' => $seniorHighSection,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch senior high section',
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
