<?php

namespace App\Http\Controllers\Api;
use App\Models\Parish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $parishes = Parish::all(); // Fetch all parishes

            return response()->json([
                'status' => 'success',
                'message' => 'Parishes fetched successfully',
                'data' => $parishes
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to fetch parishes: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch parishes at the moment'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'deanery_id' => 'required|exists:deaneries,id', // Ensure the deanery exists
        ]);

        try {
            // Create a new parish
            $parish = Parish::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Parish created successfully',
                'data' => $parish
            ], 201);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to create parish: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to create parish at the moment'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $parish = Parish::findOrFail($id); // Find the parish by ID

            return response()->json([
                'status' => 'success',
                'message' => 'Parish fetched successfully',
                'data' => $parish
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to fetch parish with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Parish not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'deanery_id' => 'required|exists:deaneries,id', // Ensure the deanery exists
        ]);

        try {
            $parish = Parish::findOrFail($id); // Find the parish by ID
            $parish->update($validated); // Update the parish

            return response()->json([
                'status' => 'success',
                'message' => 'Parish updated successfully',
                'data' => $parish
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to update parish with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update parish'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $parish = Parish::findOrFail($id); // Find the parish by ID
            $parish->delete(); // Delete the parish

            return response()->json([
                'status' => 'success',
                'message' => 'Parish deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to delete parish with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete parish'
            ], 500);
        }
    }

        /**
     * Get parishes by deanery.
     */
    public function getParishesByDeanery($deaneryId)
    {
        // Get parishes where deanery_id matches the provided deanery ID
        $parishes = Parish::where('deanery_id', $deaneryId)->get();

        // Return the response
        return response()->json([
            'status' => 'success',
            'data' => $parishes
        ]);
    }

}