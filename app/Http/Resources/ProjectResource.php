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
            'jenis_proyek' => $this->types->map(function ($type) {
                return [
                    'id' => $type->id,
                    'nama_jenis_proyek' => $type->nama_jenis_proyek,
                ];
            }),
            'partner' => $this->partner ? [
                'id' => $this->partner->id,
                'nama_partner' => $this->partner->nama_partner,
                'negara_asal' => $this->partner->negara_asal,
            ] : null,
        ];
    }
}
