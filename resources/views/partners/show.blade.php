<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $partner['nama_partner'] }} <img src="https://flagsapi.com/{{ $partner['negara_asal'] }}/shiny/64.png">
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 space-y-6">
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-4xl mx-auto px-6 space-y-6">
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h3 class="text-lg font-bold mb-4">Informasi Umum</h3>

                    <div class="space-y-2">
                        <p><strong>Nama Mitra:</strong> {{ $partner['nama_partner'] }}</p>
                        <p><strong>Asal Negara Mitra:</strong> {{ $partner['negara_asal'] }}</p>
                        <p><strong>Email Mitra:</strong> {{ $partner['email'] }}</p>
                        <p><strong>No Telepon Mitra:</strong> {{ $partner['no_telepon'] }}</p>
                    </div> 
                <div class="mt-6">
                    <a href="{{ route('partners.index') }}" class="inline-block font-semibold py-2 px-4 rounded text-white" style="background-color: #2563eb !important;">
                        Kembali ke Daftar Mitra
                    </a>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
