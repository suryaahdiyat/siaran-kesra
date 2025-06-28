<?php

namespace App\Http\Controllers;

use App\Models\Rimd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RimdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rimd::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%")
                    ->orWhere('nama_desa', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.rimd.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rimd.add');
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
            'nama_desa' => 'required|string|max:255',
            'file_rimd_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataTostore['file_rimd_before'] = $request->file('file_rimd_before')->store('rimd/before', 'public');

        Rimd::create($dataTostore);
        return redirect()->route('admin.rimd.index')->with('berhasil', 'Data RIMD berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rimd $rimd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rimd $rimd)
    {
        return view('admin.rimd.edit', compact('rimd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rimd $rimd)
    {
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_rimd_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_rimd_before')) {
            // Hapus file lama jika ada
            if ($rimd->file_rimd_before) {
                Storage::delete($rimd->file_rimd_before);
            }
            // Simpan file baru
            $dataToUpdate['file_rimd_before'] = $request->file('file_rimd_before')->store('rimd/before', 'public');
        } else {
            // Jika tidak ada file baru, tetap gunakan file lama
            $dataToUpdate['file_rimd_before'] = $rimd->file_rimd_before;
        }

        $rimd->update($dataToUpdate);
        return redirect()->route('admin.rimd.index')->with('berhasil', 'Data RIMD berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rimd $rimd)
    {
        if ($rimd->file_rimd_before) {
            Storage::delete($rimd->file_rimd_before);
        }
        if ($rimd->file_rimd_after) {
            Storage::delete($rimd->file_rimd_after);
        }

        $rimd->delete();
        return redirect()->route('admin.rimd.index')->with('berhasil', 'Data RIMD berhasil dihapus.');
    }
}
