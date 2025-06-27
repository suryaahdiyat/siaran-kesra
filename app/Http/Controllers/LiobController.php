<?php

namespace App\Http\Controllers;

use App\Models\Liob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LiobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Liob::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.liob.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.liob.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataTostore = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'file_liob_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataTostore['file_liob_before'] = $request->file('file_liob_before')->store('liob/before', 'public');

        Liob::create($dataTostore);
        return redirect()->route('admin.liob.index')->with('berhasil', 'Data LIOB berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Liob $liob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liob $liob)
    {
        return view('admin.liob.edit', compact('liob'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liob $liob)
    {
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'file_liob_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_liob_before')) {
            // Hapus file lama jika ada
            if ($liob->file_liob_before) {
                Storage::delete($liob->file_liob_before);
            }
            // Simpan file baru
            $dataToUpdate['file_liob_before'] = $request->file('file_liob_before')->store('liob/before', 'public');
        }

        $liob->update($dataToUpdate);
        return redirect()->route('admin.liob.index')->with('berhasil', 'Data LIOB berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liob $liob)
    {
        if ($liob->file_liob_before) {
            Storage::delete($liob->file_liob_before);
        }
        if ($liob->file_liob_after) {
            Storage::delete($liob->file_liob_after);
        }

        $liob->delete();
        return redirect()->route('admin.liob.index')->with('berhasil', 'Data LIOB berhasil dihapus.');
    }
}
