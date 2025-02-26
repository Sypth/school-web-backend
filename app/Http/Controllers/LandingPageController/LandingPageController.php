<?php

namespace App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LandingPage;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestRecords = LandingPage::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                  ->from('landing_pages')
                  ->groupBy('section_name');
        })->get();

        return response()->json([
            'message' => 'Landing page data retrieved successfully',
            'data' => $latestRecords,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
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
