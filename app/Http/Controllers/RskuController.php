<?php

namespace App\Http\Controllers;

use App\Models\Rsku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RskuController extends Controller
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
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%")
                    ->orWhere('nama_desa', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.rsku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        return view('admin.rsku.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $dataToStore = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_rsku_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataToStore['file_rsku_before'] = $request->file('file_rsku_before')->store('rsku/before', 'public');

        Rsku::create($dataToStore);
        return redirect()->route('admin.rsku.index')->with('berhasil', 'Data RSKU berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rsku $rsku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rsku $rsku)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        return view('admin.rsku.edit', compact('rsku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rsku $rsku)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_rsku_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_rsku_before')) {
            // Delete old file if exists
            if ($rsku->file_rsku_before) {
                Storage::delete($rsku->file_rsku_before);
            }
            $dataToUpdate['file_rsku_before'] = $request->file('file_rsku_before')->store('rsku/before', 'public');
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_rsku_before'] = $rsku->file_rsku_before;
        }

        $rsku->update($dataToUpdate);
        return redirect()->route('admin.rsku.index')->with('berhasil', 'Data RSKU berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rsku $rsku)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        if ($rsku->file_rsku_before) {
            Storage::delete($rsku->file_rsku_before);
        }

        if ($rsku->file_rsku_after) {
            Storage::delete($rsku->file_rsku_after);
        }

        // Delete the RSKU record
        $rsku->delete();

        return redirect()->route('admin.rsku.index')->with('berhasil', 'Data RSKU berhasil dihapus.');
    }
}
