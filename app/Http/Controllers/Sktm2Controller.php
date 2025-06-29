<?php

namespace App\Http\Controllers;

use App\Models\Sktm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Sktm2Controller extends Controller
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

        return view('admin.sktm.sktm2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sktm.sktm2.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $sktm = Sktm::findOrFail($id);
        return view('admin.sktm.sktm2.edit', compact('sktm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sktm = Sktm::findOrFail($id);
        // dd($request->all());
        // dd($sktm);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_sktm_after' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_sktm_after')) {
            // Delete the old file if it exists
            if ($sktm->file_sktm_after) {
                Storage::delete($sktm->file_sktm_after);
            }
            $dataToUpdate['file_sktm_after'] = $request->file('file_sktm_after')->store('sktm/after', 'public');
            $dataToUpdate['file_sktm_after_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_sktm_after'] = $sktm->file_sktm_after;
        }


        $sktm->update($dataToUpdate);
        return redirect()->route('admin.sktm2.index')->with('berhasil', 'Data SKTM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sktm $sktm)
    {
        //
    }
}
