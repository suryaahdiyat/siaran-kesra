<?php

namespace App\Http\Controllers;

use App\Models\Rimd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Rimd2Controller extends Controller
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
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.rimd.rimd2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Sktm $sktm)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rimd = Rimd::findOrFail($id);
        return view('admin.rimd.rimd2.edit', compact('rimd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rimd = Rimd::findOrFail($id);
        // dd($request->all());
        // dd($rimd);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_rimd_after' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_rimd_after')) {
            // Delete the old file if it exists
            if ($rimd->file_rimd_after) {
                Storage::delete($rimd->file_rimd_after);
            }
            $dataToUpdate['file_rimd_after'] = $request->file('file_rimd_after')->store('rimd/after', 'public');
            $dataToUpdate['file_rimd_after_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_rimd_after'] = $rimd->file_rimd_after;
        }


        $rimd->update($dataToUpdate);
        return redirect()->route('admin.rimd2.index')->with('berhasil', 'Data RIMD berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Sktm $rimd)
    // {
    //     //
    // }
}
