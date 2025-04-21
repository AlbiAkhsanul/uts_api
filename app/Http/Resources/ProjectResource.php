<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_proyek' => $this->nama_proyek,
            'estimasi_lama_proyek' => $this->estimasi_lama_proyek,
            'lokasi_proyek' => $this->lokasi_proyek,
            'pengajuan_kebutuhan_material' => $this->pengajuan_kebutuhan_material,
            'inspeksi_logistik' => $this->inspeksi_logistik,
            'ajuan_upahan' => $this->ajuan_upahan,
            'progres_proyek' => $this->progres_proyek,
            'status_proyek' => $this->status_proyek,
            'types' => $this->types->pluck('nama_jenis_proyek'),
            'partner' => $this->partner ? [
                'nama_partner' => $this->partner->nama_partner,
                'negara_asal' => $this->partner->negara_asal,
            ] : null,
        ];
    }
}
