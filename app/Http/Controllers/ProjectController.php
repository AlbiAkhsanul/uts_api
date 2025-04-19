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
        //
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
    public function store(Project $project)
    {
        // Validasi input
        $validatedData = $project->validate([
            'nama_proyek' => 'required|string|max:155',
            'estimasi_proyek' => 'required|integer',
            'project_partner' => 'required|exists:partners,id',
            'jenis_proyek' => 'required|array',
            'jenis_proyek.*' => 'exists:project_types,id',
            'lokasi_proyek' => 'required|string|max:255',
            'pengajuan_kebutuhan_material' => 'in:pending,ditolak,diterima',
            'inspeksi_logistik' => 'in:pending,ditolak,diterima',
            'ajuan_upahan' => 'in:pending,ditolak,diterima',
            'progres_proyek' => 'in:0%,25%,50%,75%,100%',
            'status_proyek' => 'in:pending,berjalan,berhenti,selesai',
        ]);

        // Simpan project
        $project = Project::create([
            'nama_proyek' => $validatedData['nama_proyek'],
            'estimasi_proyek' => $validatedData['estimasi_proyek'],
            'project_partner' => $validatedData['project_partner'],
            'lokasi_proyek' => $validatedData['lokasi_proyek'],
            'pengajuan_kebutuhan_material' => $validatedData['pengajuan_kebutuhan_material'] ?? 'pending',
            'inspeksi_logistik' => $validatedData['inspeksi_logistik'] ?? 'pending',
            'ajuan_upahan' => $validatedData['ajuan_upahan'] ?? 'pending',
            'progres_proyek' => $validatedData['progres_proyek'] ?? '0%',
            'status_proyek' => $validatedData['status_proyek'] ?? 'pending',
        ]);

        // Hubungkan ke jenis proyek
        $project->types()->sync($validatedData['jenis_proyek']);

        return response()->json(['message' => 'Proyek berhasil ditambahkan', 'data' => $project], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
