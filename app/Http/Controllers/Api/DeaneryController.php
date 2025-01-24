<?php
namespace App\Http\Controllers\Api;

use App\Models\Deanery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeaneryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    try {
        $deaneries = Deanery::all(); // Get all deaneries
        return response()->json([
            'status' => 'success',
            'message' => 'Deaneries fetched successfully',
            'data' => $deaneries
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Unable to fetch deaneries: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'Unable to fetch deaneries at the moment'
        ], 500);
    }
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        try {
            $deanery = Deanery::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Deanery created successfully',
                'data' => $deanery
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Unable to create deanery: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to create deanery at the moment'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $deanery = Deanery::findOrFail($id); // Find deanery by ID

            return response()->json([
                'status' => 'success',
                'message' => 'Deanery fetched successfully',
                'data' => $deanery
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Unable to fetch deanery with ID ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Deanery not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:255',
        ]);

        try {
            $deanery = Deanery::findOrFail($id); // Find deanery by ID

            // Update deanery fields
            $deanery->update([
                'name' => $request->name ?? $deanery->name,
                'code' => $request->code ?? $deanery->code,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Deanery updated successfully',
                'data' => $deanery
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Unable to update deanery with ID ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update deanery'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deanery = Deanery::findOrFail($id); // Find deanery by ID
            $deanery->delete(); // Delete the deanery

            return response()->json([
                'status' => 'success',
                'message' => 'Deanery deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Unable to delete deanery with ID ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete deanery'
            ], 500);
        }
    }
}