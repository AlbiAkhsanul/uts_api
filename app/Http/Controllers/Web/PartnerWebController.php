<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PartnerWebController extends Controller
{
    public function index()
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url('/api/partners'));

        if ($response->successful()) {
            $partners = $response->json()['data'];
            return view('partners.index', compact('partners'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil data partner dari API');
    }

    public function create()
    {
        return view('partners.create');
    }



    public function store(Request $request)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ])->post(url('/api/partners'), [
            'nama_partner' => $request->nama_partner,
            'negara_asal' => $request->negara_asal,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
        ]);

        dd($response->status(), $response->body());

        if ($response->successful()) {
            return redirect()->route('partners.index')->with('success', 'partner berhasil ditambahkan melalui API.');
        }

        return redirect()->back()->withErrors('Gagal menambahkan partner.');
    }

    public function show($id)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url("/api/partners/{$id}"));

        if ($response->successful()) {
            $partner = $response->json()['data'];
            return view('partners.show', compact('partner'));
        }

        return redirect()->back()->with('error', 'Gagal mengambil detail partner dari API');
    }

    public function edit($id)
    {
        $apiKey = auth()->user()->api_key;

        $partner = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get(url("/api/partners/{$id}"))->json()['data'];

        return view('partners.edit', compact('partner'));
    }


    public function update(Request $request, $id)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ])->put(url("/api/partners/{$id}"), [
            'nama_partner' => $request->nama_partner,
            'negara_asal' => $request->negara_asal,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
        ]);

        if ($response->successful()) {
            return redirect()->route('partners.index')->with('success', 'partner berhasil diperbarui melalui API.');
        }

        return redirect()->back()->withErrors('Gagal memperbarui partner.');
    }

    public function destroy($id)
    {
        $apiKey = auth()->user()->api_key;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->delete(url("/api/partners/{$id}"));

        if ($response->successful()) {
            return redirect()->route('partners.index')->with('success', 'partner berhasil dihapus melalui API.');
        }

        return redirect()->back()->withErrors('Gagal menghapus partner.');
    }
}
