<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectType;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Konstruksi',
            'Arsitek dan Desain',
            'MEP'
        ];

        foreach ($types as $type) {
            ProjectType::firstOrCreate(['nama_jenis_proyek' => $type]);
        }

        // Buat 1 contoh proyek
        $project = Project::create([
            'nama_proyek' => 'Gedung Baru XYZ',
            'estimasi_lama_proyek' => 26,
            'project_partner' => 2,
            'lokasi_proyek' => 'jogjakarta',
            'pengajuan_kebutuhan_material' => 'diterima',
            'inspeksi_logistik' => 'pending',
            'ajuan_upahan' => 'ditolak',
            'progres_proyek' => '25%',
            'status_proyek' => 'pending',
        ]);

        // Hubungkan ke jenis proyek (misalnya 1, 2)
        $projectTypes = ProjectType::whereIn('nama_jenis_proyek', ['Konstruksi', 'MEP'])->pluck('id')->toArray();
        $project->types()->sync($projectTypes);
    }
}
