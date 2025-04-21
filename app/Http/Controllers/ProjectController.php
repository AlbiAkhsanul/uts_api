<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('types', 'partner')->get();

        $projects = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'nama_proyek' => $project->nama_proyek,
                'lokasi_proyek' => $project->lokasi_proyek,
                'status_proyek' => $project->status_proyek,
                'types' => $project->types->pluck('nama_jenis_proyek'), // hanya ambil nama
                'partner' => $project->partner ? [
                    'nama_partner' => $project->partner->nama_partner,
                    'negara_asal' => $project->partner->negara_asal,
                ] : null,
            ];
        });

        return response()->json([
            'message' => 'Daftar semua proyek',
            'data' => $projects
        ], 200);
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

        return response()->json([
            'message' => 'Proyek berhasil ditambahkan',
            'data' => new ProjectResource($project)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('types', 'partner');

        return response()->json([
            'message' => 'Detail proyek ditemukan',
            'data' => new ProjectResource($project)
        ], 200);
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

        return response()->json([
            'message' => 'Proyek berhasil diperbarui',
            'data' => new ProjectResource($project)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Proyek berhasil dihapus'
        ], 200);
    }

    /**
     * Restore soft delete.
     */
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return response()->json(['message' => 'Proyek berhasil direstore'], 200);
    }

    /**
     * Permanently delete.
     */
    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return response()->json(['message' => 'Project dihapus secara permanen'], 200);
    }
}
