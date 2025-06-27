<?php

namespace App\Http\Controllers;

use App\Models\Lrp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LrpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lrp::query();

        if ($request->filled('search')) {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.lrp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lrp.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataToStore = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'file_lrp_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataToStore['file_lrp_before'] = $request->file('file_lrp_before')->store('lrp/before', 'public');

        Lrp::create($dataToStore);
        return redirect()->route('admin.lrp.index')->with('berhasil', 'Data LRP berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lrp $lrp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lrp $lrp)
    {
        return view('admin.lrp.edit', compact('lrp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lrp $lrp)
    {
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'file_lrp_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_lrp_before')) {
            // If a new file is uploaded, delete the old file
            if ($lrp->file_lrp_before) {
                Storage::delete($lrp->file_lrp_before);
            }
            // If a new file is uploaded, store it and update the path
            $dataToUpdate['file_lrp_before'] = $request->file('file_lrp_before')->store('lrp/before', 'public');
        }

        $lrp->update($dataToUpdate);
        return redirect()->route('admin.lrp.index')->with('berhasil', 'Data LRP berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lrp $lrp)
    {
        if ($lrp->file_lrp_before) {
            Storage::delete($lrp->file_lrp_before);
        }

        if ($lrp->file_lrp_after) {
            Storage::delete($lrp->file_lrp_after);
        }

        // Delete the LRP record
        $lrp->delete();
        return redirect()->route('admin.lrp.index')->with('berhasil', 'Data LRP berhasil dihapus.');
    }
}
