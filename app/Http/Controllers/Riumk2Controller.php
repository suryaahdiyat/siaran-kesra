<?php

namespace App\Http\Controllers;

use App\Models\Riumk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Riumk2Controller extends Controller
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
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.riumk.riumk2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.riumk.riumk2.add');
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
        $riumk = Riumk::findOrFail($id);
        return view('admin.riumk.riumk2.edit', compact('riumk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $riumk = Riumk::findOrFail($id);
        // dd($request->all());
        // dd($riumk);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_riumk_after' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_riumk_after')) {
            // Delete the old file if it exists
            if ($riumk->file_riumk_after) {
                Storage::delete($riumk->file_riumk_after);
            }
            $dataToUpdate['file_riumk_after'] = $request->file('file_riumk_after')->store('riumk/after', 'public');
            $dataToUpdate['file_riumk_after_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_riumk_after'] = $riumk->file_riumk_after;
        }


        $riumk->update($dataToUpdate);
        return redirect()->route('admin.riumk2.index')->with('berhasil', 'Data RIUMK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Sktm $sktm)
    // {
    //     //
    // }
}
