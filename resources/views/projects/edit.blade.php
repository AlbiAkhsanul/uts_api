<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Proyek</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 space-y-6">
        <div class="mt-6">
            <a href="{{ route('projects.index') }}" class="inline-block font-semibold py-2 px-4 rounded text-white" style="background-color: #3a881a !important;">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Proyek
            </a>                    
        </div>
        <div class="bg-gray-50 min-h-screen">
            <div class="max-w-4xl mx-auto px-6 space-y-6">
                <form action="{{ route('projects.update', $project['id']) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
        
                    <div>
                        <label for="nama_proyek">Nama Proyek</label>
                        <input type="text" name="nama_proyek" class="w-full border rounded p-2" required value="{{ $project['nama_proyek'] }}">
                    </div>
        
                    <div>
                        <label for="estimasi_lama_proyek">Estimasi Lama Proyek (Bulan)</label>
                        <input type="number" name="estimasi_lama_proyek" class="w-full border rounded p-2" required value="{{ $project['estimasi_lama_proyek'] }}">
                    </div>
        
                    <div>
                        <label for="lokasi_proyek">Lokasi Proyek</label>
                        <input type="text" name="lokasi_proyek" class="w-full border rounded p-2" required value="{{ $project['lokasi_proyek'] }}">
                    </div>
        
                    <div>
                        <label for="pengajuan_kebutuhan_material">Pengajuan Kebutuhan Material</label>
                        <select name="pengajuan_kebutuhan_material" class="w-full border rounded p-2">
                            @foreach(['pending', 'ditolak', 'diterima'] as $status)
                                <option value="{{ $status }}" {{ $project['pengajuan_kebutuhan_material'] == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div>
                        <label for="inspeksi_logistik">Inspeksi Logistik</label>
                        <select name="inspeksi_logistik" class="w-full border rounded p-2">
                            @foreach(['pending', 'ditolak', 'diterima'] as $status)
                                <option value="{{ $status }}" {{ $project['inspeksi_logistik'] == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div>
                        <label for="ajuan_upahan">Ajuan Upahan</label>
                        <select name="ajuan_upahan" class="w-full border rounded p-2">
                            @foreach(['pending', 'ditolak', 'diterima'] as $status)
                                <option value="{{ $status }}" {{ $project['ajuan_upahan'] == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div>
                        <label for="progres_proyek">Progres Proyek</label>
                        <select name="progres_proyek" class="w-full border rounded p-2">
                            @foreach(['0%', '25%', '50%', '75%', '100%'] as $progress)
                                <option value="{{ $progress }}" {{ $project['progres_proyek'] == $progress ? 'selected' : '' }}>{{ $progress }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div>
                        <label for="status_proyek">Status Proyek</label>
                        <select name="status_proyek" class="w-full border rounded p-2">
                            @foreach(['pending', 'berjalan', 'berhenti', 'selesai'] as $status)
                                <option value="{{ $status }}" {{ $project['status_proyek'] == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div>
                        <label class="block mb-2">Jenis Proyek</label>
                        <div class="flex flex-wrap gap-4">
                            @php
                                $selectedTypes = collect($project['jenis_proyek'])->pluck('id')->toArray();
                            @endphp
                            @foreach($types as $type)
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        name="jenis_proyek[]"
                                        value="{{ $type['id'] }}"
                                        class="form-checkbox text-blue-600"
                                        {{ in_array($type['id'], $selectedTypes) ? 'checked' : '' }}
                                    >
                                    <span>&nbsp;{{ $type['nama_jenis_proyek'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
        
                    <div>
                        <label for="project_partner">Partner</label>
                        <select name="project_partner" class="w-full border rounded p-2" required>
                            <option value="">-- Pilih Partner --</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner['id'] }}" {{ $project['partner']['id'] == $partner['id'] ? 'selected' : '' }}>
                                    {{ $partner['nama_partner'] }} - {{ $partner['negara_asal'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" style="background-color: #2563eb !important; color: white !important;" class="text-white font-semibold px-4 py-2 rounded shadow">
                        Update Proyek
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
