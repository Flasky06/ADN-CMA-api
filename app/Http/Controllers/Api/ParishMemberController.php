<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParishMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParishMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $parishMembers = ParishMember::all(); // Get all parish members
            return response()->json([
                'status' => 'success',
                'message' => 'Parish members fetched successfully',
                'data' => $parishMembers
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to fetch parish members: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch parish members at the moment'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|max:255',
            'IdNo' => 'nullable|string|max:255',
            'DOB' => 'nullable|date',
            'ParishCode' => 'nullable|string|max:255',
            'StationCode' => 'nullable|string|max:255',
            'Commissioned' => 'nullable|string',
            'CommissionNo' => 'nullable|string',
            'Status' => 'nullable|string',
            'photo' => 'nullable|string',
            'LithurgyStatus' => 'nullable|string',
            'DeanCode' => 'nullable|string',
            'Rpt' => 'nullable|string',
            'CellNo' => 'nullable|string|max:15',
            'Bapt' => 'nullable|string',
            'Conf' => 'nullable|string',
            'Euc' => 'nullable|string',
            'Marr' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'parish_id' => 'required|exists:parishes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        try {
            // Create the new parish member
            $parishMember = ParishMember::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Parish member created successfully',
                'data' => $parishMember
            ], 201);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to create parish member: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to create parish member at the moment'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $parishMember = ParishMember::findOrFail($id); // Find the parish member by ID
            return response()->json([
                'status' => 'success',
                'message' => 'Parish member fetched successfully',
                'data' => $parishMember
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to fetch parish member with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Parish member not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'Name' => 'nullable|string|max:255',
            'IdNo' => 'nullable|string|max:255',
            'DOB' => 'nullable|date',
            'ParishCode' => 'nullable|string|max:255',
            'StationCode' => 'nullable|string|max:255',
            'Commissioned' => 'nullable|string',
            'CommissionNo' => 'nullable|string',
            'Status' => 'nullable|string',
            'photo' => 'nullable|string',
            'LithurgyStatus' => 'nullable|string',
            'DeanCode' => 'nullable|string',
            'Rpt' => 'nullable|string',
            'CellNo' => 'nullable|string|max:15',
            'Bapt' => 'nullable|string',
            'Conf' => 'nullable|string',
            'Euc' => 'nullable|string',
            'Marr' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'parish_id' => 'nullable|exists:parishes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        try {
            // Find the parish member and update
            $parishMember = ParishMember::findOrFail($id);
            $parishMember->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Parish member updated successfully',
                'data' => $parishMember
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to update parish member with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to update parish member'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the parish member and delete
            $parishMember = ParishMember::findOrFail($id);
            $parishMember->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Parish member deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Unable to delete parish member with ID ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete parish member'
            ], 500);
        }
    }
}