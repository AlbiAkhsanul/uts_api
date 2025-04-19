<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PartnerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects', ProjectController::class);
Route::post('projects/{id}/restore', [ProjectController::class, 'restore']);
Route::delete('projects/{id}/force-delete', [ProjectController::class, 'forceDelete']);

Route::apiResource('partners', PartnerController::class);
Route::post('partners/{id}/restore', [PartnerController::class, 'restore']);
Route::delete('partners/{id}/force-delete', [PartnerController::class, 'forceDelete']);
