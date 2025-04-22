<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="table-responsive small col-lg-10 mb-5 mx-auto">
            {{-- Tambahkan tombol jika kamu butuh fitur tambah project --}}
            <a href="/projects/create" class="btn btn-primary my-3"><i class="bi bi-pencil me-1"></i>Tambah Proyek</a>

            <table class="table table-striped table-sm align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Proyek</th>
                        <th scope="col">Status</th>
                        <th scope="col">Mitra</th>
                        <th scope="col" style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project['nama_proyek'] }}</td>
                        <td>{{ ucfirst($project['status_proyek']) }}</td>
                        <td>{{ $project['nama_partner'] ?? '-' }}</td>
                        <td style="text-align: center">
                            {{-- Ganti URL dengan route yang sesuai --}}
                            <a href="/projects/{{ $project['id'] }}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill text-white"></i></a>
                            <a href="/projects/{{ $project['id'] }}/edit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square text-white"></i></a>
                            <form action="{{ route('projects.destroy', $project['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus proyek ini?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
