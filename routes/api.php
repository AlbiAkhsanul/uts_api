<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\AuthController;
use App\Models\Project;

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

Route::post('login', [AuthController::class, 'auth']);
Route::post('register', [AuthController::class, 'storeUser']);

Route::middleware('auth.apikey')->group(function () {
    Route::apiResource('projects', ProjectController::class)->names([
        'index' => 'api.projects.index',
        'store' => 'api.projects.store',
        'show' => 'api.projects.show',
        'update' => 'api.projects.update',
        'destroy' => 'api.projects.destroy',
    ]);
    Route::post('projects/{id}/restore', [ProjectController::class, 'restore']);
    Route::delete('projects/{id}/force-delete', [ProjectController::class, 'forceDelete']);

    Route::get('projectType', [ProjectTypeController::class, 'index']);

    Route::apiResource('partners', PartnerController::class)->names([
        'index' => 'api.partners.index',
        'store' => 'api.partners.store',
        'show' => 'api.partners.show',
        'update' => 'api.partners.update',
        'destroy' => 'api.partners.destroy',
    ]);
    Route::post('partners/{id}/restore', [PartnerController::class, 'restore']);
    Route::delete('partners/{id}/force-delete', [PartnerController::class, 'forceDelete']);
});
