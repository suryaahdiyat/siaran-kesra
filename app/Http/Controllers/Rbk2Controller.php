<?php

namespace App\Http\Controllers;

use App\Models\Rbk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Rbk2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rbk::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.rbk.rbk2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rbk.rbk2.add');
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
        $rbk = Rbk::findOrFail($id);
        return view('admin.rbk.rbk2.edit', compact('rbk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rbk = Rbk::findOrFail($id);
        // dd($request->all());
        // dd($rbk);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_rbk_after' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_rbk_after')) {
            // Delete the old file if it exists
            if ($rbk->file_rbk_after) {
                Storage::delete($rbk->file_rbk_after);
            }
            $dataToUpdate['file_rbk_after'] = $request->file('file_rbk_after')->store('rbk/after', 'public');
            $dataToUpdate['file_rbk_after_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_rbk_after'] = $rbk->file_rbk_after;
        }


        $rbk->update($dataToUpdate);
        return redirect()->route('admin.rbk2.index')->with('berhasil', 'Data RBK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Sktm $sktm)
    // {
    //     //
    // }
}
