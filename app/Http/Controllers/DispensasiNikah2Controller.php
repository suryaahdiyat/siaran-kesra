<?php

namespace App\Http\Controllers;

use App\Models\DispensasiNikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DispensasiNikah2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DispensasiNikah::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pria', 'like', "%{$search}%")
                    ->orWhere('nama_wanita', 'like', "%{$search}%")
                    ->orWhere('alamat_pria', 'like', "%{$search}%")
                    ->orWhere('alamat_wanita', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dispensasi.dispensasi2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dispensasi.dispensasi2.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(DispensasiNikah $dispensasi)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dispensasi = DispensasiNikah::findOrFail($id);
        return view('admin.dispensasi.dispensasi2.edit', compact('dispensasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // belum disini
        $dispensasi = DispensasiNikah::findOrFail($id);
        // dd($request->all());
        // dd($dispensasi);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_dn_selesai' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_dn_selesai')) {
            // Delete the old file if it exists
            if ($dispensasi->file_dn_selesai) {
                Storage::delete($dispensasi->file_dn_selesai);
            }
            $dataToUpdate['file_dn_selesai'] = $request->file('file_dn_selesai')->store('dispensasi/selesai', 'public');
            $dataToUpdate['file_dn_selesai_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_dn_selesai'] = $dispensasi->file_dn_selesai;
        }


        $dispensasi->update($dataToUpdate);
        return redirect()->route('admin.dispensasi2.index')->with('berhasil', 'Data Dispensasi Nikah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DispensasiNikah $dispensasi)
    {
        //
    }
}
