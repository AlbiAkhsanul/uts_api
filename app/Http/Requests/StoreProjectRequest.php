<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
        ];
    }

    /**
     * Mengubah data sebelum validasi.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'pengajuan_kebutuhan_material' => $this->pengajuan_kebutuhan_material ?? 'pending',
            'inspeksi_logistik' => $this->inspeksi_logistik ?? 'pending',
            'ajuan_upahan' => $this->ajuan_upahan ?? 'pending',
            'progres_proyek' => $this->progres_proyek ?? '0%',
            'status_proyek' => $this->status_proyek ?? 'pending',
        ]);
    }
}
