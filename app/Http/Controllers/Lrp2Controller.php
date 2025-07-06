<?php

namespace App\Http\Controllers;

use App\Models\Lrp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Lrp2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lrp::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.lrp.lrp2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lrp.lrp2.add');
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
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $lrp = Lrp::findOrFail($id);
        return view('admin.lrp.lrp2.edit', compact('lrp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $lrp = Lrp::findOrFail($id);
        // dd($request->all());
        // dd($lrp);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_lrp_after' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_lrp_after')) {
            // Delete the old file if it exists
            if ($lrp->file_lrp_after) {
                Storage::delete($lrp->file_lrp_after);
            }
            $dataToUpdate['file_lrp_after'] = $request->file('file_lrp_after')->store('lrp/after', 'public');
            $dataToUpdate['file_lrp_after_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_lrp_after'] = $lrp->file_lrp_after;
        }


        $lrp->update($dataToUpdate);
        return redirect()->route('admin.lrp2.index')->with('berhasil', 'Data LRP berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Sktm $sktm)
    // {
    //     //
    // }
}
