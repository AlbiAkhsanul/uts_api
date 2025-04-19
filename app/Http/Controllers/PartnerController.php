<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return response()->json($partners);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $validatedData = $request->validated();

        $partner = Partner::create($validatedData);

        return response()->json(['message' => 'Mitra berhasil ditambahkan', 'data' => $partner], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partner = Partner::findOrFail($id);
        return response()->json($partner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $validatedData = $request->validated();

        $partner->update($validatedData);

        return response()->json(['message' => 'Mitra berhasil diperbarui', 'data' => $partner]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return response()->json([
            'message' => 'Mitra berhasil dihapus'
        ]);
    }

    /**
     * Restore soft delete.
     */
    public function restore($id)
    {
        $partner = Partner::withTrashed()->findOrFail($id);
        $partner->restore();

        return response()->json(['message' => 'Mitra berhasil direstore']);
    }

    /**
     * Permanently delete.
     */
    public function forceDelete($id)
    {
        $partner = Partner::onlyTrashed()->findOrFail($id);
        $partner->forceDelete();

        return response()->json(['message' => 'Mitra dihapus secara permanen']);
    }
}
