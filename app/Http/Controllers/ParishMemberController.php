<?php

namespace App\Http\Controllers;

use App\Models\Parish;
use App\Models\ParishMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParishMemberController extends Controller
{
    // Show the form to create a new parish member

    // Store a new parish member in the database
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'Commissioned' => 'nullable|boolean',
                'CommissionNo' => 'nullable|string|max:255',
                'DateJoin' => 'nullable|date',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the photo upload
                'IdNo' => 'nullable|string|max:255',
                'CellNo' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'Status' => 'nullable|string|in:Active,Pending',
                'parish_id' => 'required|exists:parishes,id',
            ]);

            // Handle file upload for photo
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('parish_members', 'public');
            } else {
                $photoPath = null; // No photo uploaded
            }

            // Create a new parish member
            ParishMember::create([
                'name' => $validated['name'],
                'Commissioned' => $validated['Commissioned'] ?? false,
                'CommissionNo' => $validated['CommissionNo'],
                'DateJoin' => $validated['DateJoin'],
                'photo' => $photoPath,
                'IdNo' => $validated['IdNo'],
                'CellNo' => $validated['CellNo'],
                'email' => $validated['email'],
                'Status' => $validated['Status'] ?? 'Pending',
                'parish_id' => $validated['parish_id'],
            ]);

            return response()->json(['message' => 'Parish member created successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // Display a list of all parish members
    public function index()
    {
        $parishMembers = ParishMember::all(); // You can customize the query here for pagination, etc.
        return view('parish_members.index', compact('parishMembers'));
    }

    // Show the form to edit an existing parish member
    public function edit(ParishMember $parishMember)
    {
        $parishes = Parish::all();
        return view('parish_members.edit', compact('parishMember', 'parishes'));
    }

    // Update the parish member details
    public function update(Request $request, ParishMember $parishMember)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'Commissioned' => 'nullable|boolean',
            'CommissionNo' => 'nullable|string|max:255',
            'DateJoin' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'IdNo' => 'nullable|string|max:255',
            'CellNo' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'Status' => 'nullable|string|in:Active,Pending',
            'parish_id' => 'required|exists:parishes,id',
        ]);

        // Handle file upload for photo (if any)
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($parishMember->photo) {
                Storage::disk('public')->delete($parishMember->photo);
            }
            $photoPath = $request->file('photo')->store('parish_members', 'public');
        } else {
            $photoPath = $parishMember->photo;
        }

        // Update the parish member
        $parishMember->update([
            'name' => $validated['name'],
            'Commissioned' => $validated['Commissioned'] ?? false,
            'CommissionNo' => $validated['CommissionNo'],
            'DateJoin' => $validated['DateJoin'],
            'photo' => $photoPath,
            'IdNo' => $validated['IdNo'],
            'CellNo' => $validated['CellNo'],
            'email' => $validated['email'],
            'Status' => $validated['Status'] ?? 'Pending',
            'parish_id' => $validated['parish_id'],
        ]);

        return redirect()->route('parish_members.index')->with('success', 'Parish member updated successfully!');
    }

    // Delete a parish member
    public function destroy(ParishMember $parishMember)
    {
        // Delete the parish member's photo if exists
        if ($parishMember->photo) {
            Storage::disk('public')->delete($parishMember->photo);
        }

        // Delete the parish member
        $parishMember->delete();

        return redirect()->route('parish_members.index')->with('success', 'Parish member deleted successfully!');
    }
}
