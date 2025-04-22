<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mitra Baru</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 space-y-6">
        <div class="mt-6">
            <a href="{{ route('partners.index') }}" class="inline-block font-semibold py-2 px-4 rounded text-white" style="background-color: #3a881a !important;">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Mitra
            </a>                    
        </div>
        <div class="bg-gray-50 min-h-screen">
            <div class="max-w-4xl mx-auto px-6 space-y-6">
                <form action="{{ route('partners.store') }}" method="POST" class="space-y-6">
                    @csrf
        
                    <div>
                        <label for="nama_partner">Nama Mitra</label>
                        <input type="text" name="nama_partner" class="w-full border rounded p-2" required>
                    </div>

                    <div>
                        <label for="negara_asal">Negara Asal Mitra (Tulis Kode Negara Saja : contoh SG = Singapore)</label>
                        <input type="text" id="negara_asal" name="negara_asal" class="w-full border rounded p-2" required>
                    </div>
                    <!-- Preview bendera -->
                    <div class="mt-2">
                        <img id="flag-preview" src="" alt="Flag preview" class="h-10" style="display: none;">
                    </div>
        
                    <div>
                        <label for="no_telepon">Nomor Telepon Mitra</label>
                        <input type="text" name="no_telepon" class="w-full border rounded p-2" required>
                    </div>
        
                    <div>
                        <label for="email">Email Mitra</label>
                        <input type="text" name="email" class="w-full border rounded p-2" required>
                    </div>
        
                    <button type="submit" style="background-color: #2563eb !important; color: white !important;" class="text-white font-semibold px-4 py-2 rounded shadow">
                        Tambah Proyek
                    </button>                                   
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const negaraInput = document.getElementById('negara_asal');
                        const flagPreview = document.getElementById('flag-preview');
                        
                        // Buat elemen notice
                        let notice = document.createElement('p');
                        notice.id = 'flag-error';
                        notice.style.color = 'red';
                        notice.style.display = 'none';
                        flagPreview.parentNode.appendChild(notice);
                
                        negaraInput.addEventListener('input', function () {
                            const code = negaraInput.value.trim().toUpperCase();
                            
                            if (code.length === 2) {
                                const url = `https://flagsapi.com/${code}/shiny/64.png`;
                                flagPreview.src = url;
                                flagPreview.style.display = 'inline';
                                notice.style.display = 'none';
                
                                // Tambahkan handler untuk error jika gambar gagal dimuat
                                flagPreview.onerror = function () {
                                    flagPreview.style.display = 'none';
                                    notice.textContent = `Negara dengan kode "${code}" tidak ditemukan.`;
                                    notice.style.display = 'block';
                                };
                
                                // Jika berhasil dimuat, sembunyikan pesan error
                                flagPreview.onload = function () {
                                    notice.style.display = 'none';
                                };
                
                            } else {
                                flagPreview.style.display = 'none';
                                notice.style.display = 'none';
                            }
                        });
                    });
                </script>                               
            </div>
        </div>
    </div>
</x-app-layout>

