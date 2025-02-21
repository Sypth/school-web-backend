<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function public()
    {
        return response()->json([
            'message' => 'Test data retrieved successfully',
            'data' => [
                'test' => 'test data',
                'testCollection' => [
                    'testString' => 'test data 1',
                    'testNumber' => 123,
                    'testBool' => true
                ]
            ],
        ]);
    }

    public function permitted()
    {
        return response()->json([
            'message' => 'Permitted data retrieved successfully',
            'data' => [
                'permitted' => 'permitted data',
                'permittedCollection' => [
                    'permittedString' => 'permitted data 1',
                    'permittedNumber' => 456,
                    'permittedBool' => false
                ]
            ],
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
