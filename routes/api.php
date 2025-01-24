<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DioceseController;
use App\Http\Controllers\Api\ParishController;
use App\Http\Controllers\Api\DeaneryController;
use App\Http\Controllers\Api\ParishMemberController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    // User profile route (requires authentication)
    Route::get('user', 'userProfile')->middleware('auth:sanctum');

    // Logout route (requires authentication)
    Route::get('logout', 'userLogout')->middleware('auth:sanctum');
});

// Diocese routes
Route::get('/dioceses', [DioceseController::class, 'index']); // List all dioceses
Route::get('/dioceses/{id}', [DioceseController::class, 'show']); // Show a specific diocese


// Deanery routes
Route::prefix('deaneries')->group(function () {
    Route::get('/', [DeaneryController::class, 'index']);         // List all deaneries
    Route::post('/', [DeaneryController::class, 'store']);        // Create a new deanery
    Route::get('{id}', [DeaneryController::class, 'show']);       // Show a specific deanery
    Route::put('{id}', [DeaneryController::class, 'update']);     // Update a specific deanery
    Route::delete('{id}', [DeaneryController::class, 'destroy']); // Delete a specific deanery
});


// Parish routes
Route::prefix('parishes')->group(function () {
    Route::get('/', [ParishController::class, 'index']);          // List all parishes
    Route::post('/', [ParishController::class, 'store']);         // Create a new parish
    Route::get('{id}', [ParishController::class, 'show']);        // Show a specific parish
    Route::put('{id}', [ParishController::class, 'update']);      // Update a specific parish
    Route::delete('{id}', [ParishController::class, 'destroy']);  // Delete a specific parish
    Route::get('by-deanery/{deaneryId}', [ParishController::class, 'getParishesByDeanery']); // Fetch parishes by deanery
});


Route::prefix('parish')->group(function () {
    // Parish member routes
    Route::get('parish-members', [ParishMemberController::class, 'index']);       // List all parish members
    Route::post('parish-members', [ParishMemberController::class, 'store']);      // Create a new parish member
    Route::get('parish-members/{id}', [ParishMemberController::class, 'show']);    // Show a specific parish member
    Route::put('parish-members/{id}', [ParishMemberController::class, 'update']); // Update a specific parish member
    Route::delete('parish-members/{id}', [ParishMemberController::class, 'destroy']); // Delete a specific parish member
});