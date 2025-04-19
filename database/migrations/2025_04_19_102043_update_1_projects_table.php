<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('lokasi_proyek');
            $table->enum('pengajuan_kebutuhan_material', ['pending', 'ditolak', 'diterima'])->default('pending');
            $table->enum('inspeksi_logistik', ['pending', 'ditolak', 'diterima'])->default('pending');
            $table->enum('ajuan_upahan', ['pending', 'ditolak', 'diterima'])->default('pending');
            $table->enum('progres_proyek', ['0%', '25%', '50%', '75%', '100%'])->default('0%');
            $table->enum('status_proyek', ['pending', 'berjalan', 'berhenti', 'selesai'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['lokasi_proyek', 'pengajuan_kebutuhan_material', 'inspeksi_logistik', 'ajuhan_upahan', 'progres_proyek', 'status_proyek']);
        });
    }
};
