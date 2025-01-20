<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/DioceseController.php
namespace App\Http\Controllers;

use App\Models\Diocese;
use App\Models\Deanery;
use App\Models\Parish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DioceseController extends Controller
{
    /**
     * Create a new Diocese.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $diocese = Diocese::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return response()->json($diocese, 201);
    }

    /**
     * Create a new Deanery within a Diocese.
     */
    public function createDeanery(Request $request, $dioceseId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        $diocese = Diocese::findOrFail($dioceseId);

        $deanery = $diocese->deaneries()->create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return response()->json($deanery, 201);
    }

    

    /**
     * Create a new Parish within a Deanery.
     */
    public function createParish(Request $request, $deaneryCode)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);
    
        // Look for the deanery by code
        $deanery = Deanery::where('code', $deaneryCode)->first();
    
        // Return error if deanery is not found
        if (!$deanery) {
            return response()->json(['message' => 'Deanery not found'], 404);
        }
    
        // Create a new parish and associate it with the deanery
        $parish = new Parish();
        $parish->name = $request->name;
        $parish->code = $request->code;
        $parish->deanery_id = $deanery->id;
        $parish->save();
    
        // Return success response
        return response()->json(['message' => 'Parish created successfully'], 201);
    }
    


    /**
     * Show a Diocese by ID.
     */
    public function show($dioceseId)
    {
        $diocese = Diocese::findOrFail($dioceseId);
        return response()->json($diocese);
    }

    /**
     * Update a Diocese by ID.
     */
    public function update(Request $request, $dioceseId)
    {
        $diocese = Diocese::findOrFail($dioceseId);

        $diocese->update($request->all());

        return response()->json($diocese);
    }

    /**
     * Delete a Diocese by ID.
     */
    public function destroy($dioceseId)
    {
        $diocese = Diocese::findOrFail($dioceseId);
        $diocese->delete();

        return response()->json(null, 204);
    }
}