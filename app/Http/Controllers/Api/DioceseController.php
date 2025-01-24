<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Diocese;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DioceseController extends Controller
{
    /**
     * Display a listing of dioceses.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $dioceses = Diocese::paginate(10);

            return response()->json([
                'status' => 'success',
                'message' => 'Dioceses fetched successfully',
                'data' => $dioceses
            ], 200);

        } catch (\Exception $e) {
            Log::error('Unable to fetch dioceses: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch dioceses at the moment',
                'error' => $e->getMessage() // Include error message in response
            ], 500);
        }
    }

    /**
     * Display the specified diocese.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $diocese = Diocese::findOrFail($id); // Find diocese by ID

            return response()->json([
                'status' => 'success',
                'message' => 'Diocese fetched successfully',
                'data' => $diocese
            ], 200);

        } catch (\Exception $e) {
            Log::error('Unable to fetch diocese with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Diocese not found',
                'error' => $e->getMessage() // Include error details in response
            ], 404);
        }
    }
}