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
        // Pastikan jenis proyek sudah ada
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
            'estimasi_lama_proyek' => 180,
            'project_partner' => 1,
        ]);

        // Hubungkan ke jenis proyek (misalnya 1, 2)
        $projectTypes = ProjectType::whereIn('nama_jenis_proyek', ['Konstruksi', 'MEP'])->pluck('id')->toArray();
        $project->types()->sync($projectTypes);
    }
}
