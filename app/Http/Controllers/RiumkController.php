<?php

namespace App\Http\Controllers;

use App\Models\Riumk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Svg\Tag\Rect;

class RiumkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Riumk::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%")
                    ->orWhere('nama_desa', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.riumk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.riumk.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataTostore = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_riumk_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataTostore['file_riumk_before'] = $request->file('file_riumk_before')->store('riumk/before', 'public');

        Riumk::create($dataTostore);
        return redirect()->route('admin.riumk.index')->with('berhasil', 'Data RIUMK berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Riumk $riumk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riumk $riumk)
    {
        return view('admin.riumk.edit', compact('riumk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riumk $riumk)
    {
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_riumk_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_riumk_before')) {
            // Hapus file lama jika ada
            if ($riumk->file_riumk_before) {
                Storage::delete($riumk->file_riumk_before);
            }
            // Simpan file baru
            $dataToUpdate['file_riumk_before'] = $request->file('file_riumk_before')->store('riumk/before', 'public');
        } else {
            // Jika tidak ada file baru, tetap gunakan file lama
            $dataToUpdate['file_riumk_before'] = $riumk->file_riumk_before;
        }

        $riumk->update($dataToUpdate);
        return redirect()->route('admin.riumk.index')->with('berhasil', 'Data RIUMK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riumk $riumk)
    {
        if ($riumk->file_riumk_before) {
            Storage::delete($riumk->file_riumk_before);
        }
        if ($riumk->file_riumk_after) {
            Storage::delete($riumk->file_riumk_after);
        }

        $riumk->delete();
        return redirect()->route('admin.riumk.index')->with('berhasil', 'Data RIUMK berhasil dihapus.');
    }
}
