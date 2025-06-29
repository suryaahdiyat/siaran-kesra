<?php

namespace App\Http\Controllers;

use App\Models\Sl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sl::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('jenis_surat', 'like', "%{$search}%")
                    ->orWhere('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.sl.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sl.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $dataTostore = $request->validate([
            'jenis_surat' => 'required|string|max:255',
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_sl_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // dd($request->all());

        $dataTostore['file_sl_before'] = $request->file('file_sl_before')->store('sl/before', 'public');

        SL::create($dataTostore);

        return redirect()->route('admin.sl.index')->with('berhasil', 'Data SL berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sl $sl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sl $sl)
    {
        return view('admin.sl.edit', [
            'sl' => $sl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sl $sl)
    {
        $dataToUpdate = $request->validate([
            'jenis_surat' => 'required|string|max:255',
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_sl_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_sl_before')) {
            // Hapus file lama jika ada
            if ($sl->file_sl_before) {
                Storage::delete($sl->file_sl_before);
            }
            // Simpan file baru
            $dataToUpdate['file_sl_before'] = $request->file('file_sl_before')->store('sl/before', 'public');
        } else {
            // Jika tidak ada file baru, tetap gunakan file lama
            $dataToUpdate['file_sl_before'] = $sl->file_sl_before;
        }

        $sl->update($dataToUpdate);

        return redirect()->route('admin.sl.index')->with('berhasil', 'Data SL berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sl $sl)
    {
        if ($sl->file_sl_before) {
            Storage::delete($sl->file_sl_before);
        }
        if ($sl->file_sl_after) {
            Storage::delete($sl->file_sl_after);
        }

        $sl->delete();
        return redirect()->route('admin.sl.index')->with('berhasil', 'Data SL berhasil dihapus.');
    }
}
