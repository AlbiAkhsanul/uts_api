<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;


class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectType = ProjectType::all();
        return response()->json([
            'message' => 'Daftar semua tipe proyek',
            'data' => $projectType
        ], 200);
    }
}
