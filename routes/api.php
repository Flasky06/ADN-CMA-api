<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DioceseController;
use App\Http\Controllers\ParishMemberController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('register','register');
    Route::post('login','login');

    Route::get('user','userProfile')->middleware('auth:sanctum');

    Route::get('logout','userLogout')->middleware('auth:sanctum');

});

// Diocese Routes
Route::post('/dioceses', [DioceseController::class, 'create']); // Create a new diocese
Route::get('/dioceses/{dioceseId}', [DioceseController::class, 'show']); // Show a specific diocese
Route::put('/dioceses/{dioceseId}', [DioceseController::class, 'update']); // Update a specific diocese
Route::delete('/dioceses/{dioceseId}', [DioceseController::class, 'destroy']); // Delete a specific diocese

// Deanery Routes
Route::post('/dioceses/{dioceseId}/deaneries', [DioceseController::class, 'createDeanery']); // Create a deanery in a diocese

// Parish Routes
Route::post('/deaneries/{deaneryCode}/parishes', [DioceseController::class, 'createParish']); // Create a parish in a deanery



// API Routes for Parish Members
Route::prefix('parish-members')->group(function () {
    // Create a new parish member
    Route::post('/', [ParishMemberController::class, 'store'])->name('parish-members.store');

    // List all parish members
    Route::get('/', [ParishMemberController::class, 'index'])->name('parish-members.index');

    // Edit a parish member (optional for API, usually web)
    Route::get('{id}/edit', [ParishMemberController::class, 'edit'])->name('parish-members.edit');

    // Update a parish member
    Route::put('{id}', [ParishMemberController::class, 'update'])->name('parish-members.update');

    // Delete a parish member
    Route::delete('{id}', [ParishMemberController::class, 'destroy'])->name('parish-members.destroy');
});