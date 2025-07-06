<?php

namespace App\Http\Controllers;

use App\Models\Rbk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RbkController extends Controller
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
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%")
                    ->orWhere('nama_desa', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.rbk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        return view('admin.rbk.add');
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
            'file_rbk_before' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $dataToStore['file_rbk_before'] = $request->file('file_rbk_before')->store('rbk/before', 'public');

        Rbk::create($dataToStore);
        return redirect()->route('admin.rbk.index')->with('berhasil', 'Data RBK berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rbk $rbk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rbk $rbk)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        return view('admin.rbk.edit', compact('rbk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rbk $rbk)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $dataToUpdate = $request->validate([
            'nama_pengantar' => 'required|string|max:255',
            'alamat_pengantar' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'file_rbk_before' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_rbk_before')) {
            // Delete old file if exists
            if ($rbk->file_rbk_before) {
                Storage::delete($rbk->file_rbk_before);
            }
            $dataToUpdate['file_rbk_before'] = $request->file('file_rbk_before')->store('rbk/before', 'public');
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_rbk_before'] = $rbk->file_rbk_before;
        }

        $rbk->update($dataToUpdate);
        return redirect()->route('admin.rbk.index')->with('berhasil', 'Data RBK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rbk $rbk)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        if ($rbk->file_rbk_before) {
            Storage::delete($rbk->file_rbk_before);
        }
        // If there are other files associated with RBK, delete them as well
        if ($rbk->file_rbk_after) {
            Storage::delete($rbk->file_rbk_after);
        }

        // Delete the RBK record
        $rbk->delete();

        return redirect()->route('admin.rbk.index')->with('berhasil', 'Data RBK berhasil dihapus.');
    }
}
