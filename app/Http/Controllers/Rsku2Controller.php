<?php

namespace App\Http\Controllers;

use App\Models\Rsku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Rsku2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rsku::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.rsku.rsku2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rsku.rsku2.add');
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
    // public function show(Sktm $sktm)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rsku = Rsku::findOrFail($id);
        return view('admin.rsku.rsku2.edit', compact('rsku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rsku = Rsku::findOrFail($id);
        // dd($request->all());
        // dd($rsku);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_rsku_after' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_rsku_after')) {
            // Delete the old file if it exists
            if ($rsku->file_rsku_after) {
                Storage::delete($rsku->file_rsku_after);
            }
            $dataToUpdate['file_rsku_after'] = $request->file('file_rsku_after')->store('rsku/after', 'public');
            $dataToUpdate['file_rsku_after_uploaded_at'] = now();
        }


        $rsku->update($dataToUpdate);
        return redirect()->route('admin.rsku2.index')->with('berhasil', 'Data RSKU berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Sktm $sktm)
    // {
    //     //
    // }
}
