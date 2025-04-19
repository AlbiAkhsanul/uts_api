<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('types', 'partner')->get();

        return response()->json([
            'message' => 'Daftar semua proyek',
            'data' => $projects
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validatedData = $request->validated();

        $project = Project::create($validatedData);

        $project->types()->sync($validatedData['jenis_proyek']);

        return response()->json(['message' => 'Proyek berhasil ditambahkan', 'data' => $project], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('types', 'partner');

        return response()->json([
            'message' => 'Detail proyek ditemukan',
            'data' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();

        $project->update($validatedData);

        $project->types()->sync($validatedData['jenis_proyek']);

        return response()->json(['message' => 'Proyek berhasil diperbarui', 'data' => $project], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Proyek berhasil dihapus'
        ]);
    }

    /**
     * Restore soft delete.
     */
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return response()->json(['message' => 'Proyek berhasil direstore']);
    }

    /**
     * Permanently delete.
     */
    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return response()->json(['message' => 'Project dihapus secara permanen']);
    }
}
