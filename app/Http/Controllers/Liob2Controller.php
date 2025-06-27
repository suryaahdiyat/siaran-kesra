<?php

namespace App\Http\Controllers;

use App\Models\Liob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Liob2Controller extends Controller
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

        return view('admin.liob.liob2.index', compact('data'));
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
        $liob = Liob::findOrFail($id);
        return view('admin.liob.liob2.edit', compact('liob'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $liob = Liob::findOrFail($id);
        // dd($request->all());
        // dd($liob);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_liob_after' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_liob_after')) {
            // Delete the old file if it exists
            if ($liob->file_liob_after) {
                Storage::delete($liob->file_liob_after);
            }
            $dataToUpdate['file_liob_after'] = $request->file('file_liob_after')->store('liob/after', 'public');
            $dataToUpdate['file_liob_after_uploaded_at'] = now();
        }


        $liob->update($dataToUpdate);
        return redirect()->route('admin.liob2.index')->with('berhasil', 'Data LIOB berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Sktm $liob)
    // {
    //     //
    // }
}
