<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProjectWebController extends Controller
{
    public function index()
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url('/api/projects'));

        if ($response->successful()) {
            $projects = $response->json()['data'];
            return view('projects.index', compact('projects'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data proyek dari API');
    }

    public function create()
    {
        $apiKey = auth()->user()->api_key;

        $types = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url('/api/projectType'))->json()['data'];

        $partners = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url('/api/partners'))->json()['data'];

        return view('projects.create', compact('types', 'partners'));
    }



    public function store(Request $request)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ])->post(url('/api/projects'), [
            'nama_proyek' => $request->nama_proyek,
            'estimasi_lama_proyek' => $request->estimasi_lama_proyek,
            'project_partner' => $request->project_partner,
            'jenis_proyek' => $request->jenis_proyek,
            'lokasi_proyek' => $request->lokasi_proyek,
            'pengajuan_kebutuhan_material' => $request->pengajuan_kebutuhan_material,
            'inspeksi_logistik' => $request->inspeksi_logistik,
            'ajuan_upahan' => $request->ajuan_upahan,
            'progres_proyek' => $request->progres_proyek,
            'status_proyek' => $request->status_proyek,
        ]);

        if ($response->successful()) {
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan melalui API.');
        }

        return redirect()->back()->withErrors('Gagal menambahkan proyek.');
    }

    public function show($id)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url("/api/projects/{$id}"));

        if ($response->successful()) {
            $project = $response->json()['data'];
            return view('projects.show', compact('project'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil detail proyek dari API');
    }

    public function edit($id)
    {
        $apiKey = auth()->user()->api_key;

        $project = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url("/api/projects/{$id}"))->json()['data'];

        $types = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url('/api/projectType'))->json()['data'];

        $partners = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url('/api/partners'))->json()['data'];

        return view('projects.edit', compact('project', 'types', 'partners'));
    }


    public function update(Request $request, $id)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ])->put(url("/api/projects/{$id}"), [
            'nama_proyek' => $request->nama_proyek,
            'estimasi_lama_proyek' => $request->estimasi_lama_proyek,
            'project_partner' => $request->project_partner,
            'jenis_proyek' => $request->jenis_proyek,
            'lokasi_proyek' => $request->lokasi_proyek,
            'pengajuan_kebutuhan_material' => $request->pengajuan_kebutuhan_material,
            'inspeksi_logistik' => $request->inspeksi_logistik,
            'ajuan_upahan' => $request->ajuan_upahan,
            'progres_proyek' => $request->progres_proyek,
            'status_proyek' => $request->status_proyek,
        ]);

        if ($response->successful()) {
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui melalui API.');
        }

        return redirect()->back()->withErrors('Gagal memperbarui proyek.');
    }

    public function destroy($id)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->delete(url("/api/projects/{$id}"));

        if ($response->successful()) {
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus melalui API.');
        }

        return redirect()->back()->withErrors('Gagal menghapus proyek.');
    }
}
