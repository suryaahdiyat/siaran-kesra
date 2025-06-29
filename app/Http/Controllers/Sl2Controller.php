<?php


namespace App\Http\Controllers;

use App\Models\Sl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Sl2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sl::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengantar', 'like', "%{$search}%")
                    ->orWhere('alamat_pengantar', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.sl.sl2.index', compact('data'));
    }

    public function edit($id)
    {
        $sl = Sl::findOrFail($id);
        return view('admin.sl.sl2.edit', compact('sl'));
    }


    public function update(Request $request, $id)
    {
        $sl = Sl::findOrFail($id);
        // dd($request->all());
        // dd($sl);
        $dataToUpdate = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'file_sl_after' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the uploaded file
        if ($request->hasFile('file_sl_after')) {
            // Delete the old file if it exists
            if ($sl->file_sl_after) {
                Storage::delete($sl->file_sl_after);
            }
            $dataToUpdate['file_sl_after'] = $request->file('file_sl_after')->store('sl/after', 'public');
            $dataToUpdate['file_sl_after_uploaded_at'] = now();
        } else {
            // If no new file is uploaded, keep the old file
            $dataToUpdate['file_sl_after'] = $sl->file_sl_after;
        }


        $sl->update($dataToUpdate);
        return redirect()->route('admin.sl2.index')->with('berhasil', 'Data SL berhasil diperbarui.');
    }
}
