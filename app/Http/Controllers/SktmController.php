<?php

namespace App\Http\Controllers;

use App\Models\Sktm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SktmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sktm::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.sktm.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sktm.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $dataTostore = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'file_sktm_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataTostore['file_sktm_before'] = $request->file('file_sktm_before')->store('sktm/before', 'public');

        Sktm::create($dataTostore);
        return redirect()->route('admin.sktm.index')->with('berhasil', 'Data SKTM berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sktm $sktm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sktm $sktm)
    {
        return view('admin.sktm.edit', [
            'sktm' => $sktm,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sktm $sktm)
    {
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'file_sktm_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_sktm_before')) {
            // Hapus file lama jika ada
            if ($sktm->file_sktm_before) {
                Storage::delete($sktm->file_sktm_before);
            }
            // Simpan file baru
            $dataToUpdate['file_sktm_before'] = $request->file('file_sktm_before')->store('sktm/before', 'public');
        }

        $sktm->update($dataToUpdate);
        return redirect()->route('admin.sktm.index')->with('berhasil', 'Data SKTM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sktm $sktm)
    {
        if ($sktm->file_sktm_before) {
            Storage::delete($sktm->file_sktm_before);
        }
        if ($sktm->file_sktm_after) {
            Storage::delete($sktm->file_sktm_after);
        }

        $sktm->delete();
        return redirect()->route('admin.sktm.index')->with('berhasil', 'Data SKTM berhasil dihapus.');
    }
}
