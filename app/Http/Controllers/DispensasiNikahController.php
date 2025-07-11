<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DispensasiNikah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;

Carbon::setLocale('id');
class DispensasiNikahController extends Controller
{
    /**
     * Menampilkan form pengajuan dispensasi nikah untuk publik.
     */
    public function create()
    {
        return view('public.dispensasi.create');
    }

    /**
     * Menyimpan data pengajuan baru dari form publik (VERSI RESET).
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi semua data yang masuk dari form.
        $validated = $request->validate([
            'nomor_surat_kua'       => 'required|string|max:255',
            'tanggal_nikah'         => 'required|date',
            'file_surat_kua'        => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'nama_pria'             => 'required|string|max:255',
            'jenis_kelamin_pria'    => 'required|string',
            'tempat_lahir_pria'     => 'required|string|max:100',
            'tanggal_lahir_pria'    => 'required|date',
            'agama_pria'            => 'required|string',
            'pekerjaan_pria'        => 'required|string|max:100',
            'desa_pria'             => 'required|string',
            'desa_pria_lainnya'     => 'nullable|string|max:100', // Input tambahan jika pilih "Lainnya"
            'alamat_pria'           => 'required|string',
            // 'pernah_nikah_pria'   => 'required|boolean',
            'file_bukti_cerai_pria' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'nama_wanita'           => 'required|string|max:255',
            'jenis_kelamin_wanita'  => 'required|string',
            'tempat_lahir_wanita'   => 'required|string|max:100',
            'tanggal_lahir_wanita'  => 'required|date',
            'agama_wanita'          => 'required|string',
            'pekerjaan_wanita'      => 'required|string|max:100',
            'desa_wanita'           => 'required|string',
            'desa_wanita_lainnya'   => 'nullable|string|max:100', // Input tambahan jika pilih "Lainnya"
            'alamat_wanita'         => 'required|string',
            // 'pernah_nikah_wanita' => 'required|boolean',
            'file_bukti_cerai_wanita' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
        ]);

        // dd($validated);

        // Siapkan array data yang akan disimpan, dimulai dengan data yang sudah tervalidasi
        $dataToStore = $validated;

        $dataToStore['pernah_nikah_pria'] = $request->hasFile('file_bukti_cerai_pria');
        $dataToStore['pernah_nikah_wanita'] = $request->hasFile('file_bukti_cerai_wanita');

        // dd($dataToStore);

        // Proses file-file dan tambahkan path-nya ke array
        $dataToStore['file_surat_kua'] = $request->file('file_surat_kua')->store('dispensasi/surat_kua', 'public');

        $dataToStore['file_bukti_cerai_pria'] = $request->hasFile('file_bukti_cerai_pria')
            ? $request->file('file_bukti_cerai_pria')->store('dispensasi/bukti_cerai', 'public')
            : null;

        $dataToStore['file_bukti_cerai_wanita'] = $request->hasFile('file_bukti_cerai_wanita')
            ? $request->file('file_bukti_cerai_wanita')->store('dispensasi/bukti_cerai', 'public')
            : null;

        // dd($dataToStore);

        // Simpan semua data dari array $dataToStore ke database
        DispensasiNikah::create($dataToStore);

        return redirect('/')->with('berhasil', 'Pengajuan dispensasi nikah Anda telah berhasil dikirim!');
    }

    /**
     * Menampilkan tabel data pengajuan untuk admin.
     */
    public function index(Request $request)
    {
        $query = DispensasiNikah::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pria', 'like', "%{$search}%")
                    ->orWhere('nama_wanita', 'like', "%{$search}%")
                    ->orWhere('desa_pria', 'like', "%{$search}%")
                    ->orWhere('desa_pria_lainnya', 'like', value: "%{$search}%")
                    ->orWhere('desa_wanita', 'like', "%{$search}%")
                    ->orWhere('desa_wanita_lainnya', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dispensasi.index', compact('data'));
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        // dd($id);
        $data = DispensasiNikah::findOrFail($id);
        // dd($data);
        return view('admin.dispensasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $dispensasi_nikah = DispensasiNikah::findOrFail($id);
        // dd($dispensasi_nikah);

        $validated = $request->validate([
            'nomor_surat_kua'       => 'required|string|max:255',
            'tanggal_nikah'         => 'required|date',
            'nama_pria'             => 'required|string|max:255',
            'jenis_kelamin_pria'    => 'required|string',
            'tempat_lahir_pria'     => 'required|string|max:100',
            'tanggal_lahir_pria'    => 'required|date',
            'agama_pria'            => 'required|string',
            'pekerjaan_pria'        => 'required|string|max:100',
            'desa_pria'             => 'required|string',
            'desa_pria_lainnya'     => 'nullable|string|max:100', // Input tambahan jika pilih "Lainnya"
            'alamat_pria'           => 'required|string',
            'nama_wanita'           => 'required|string|max:255',
            'jenis_kelamin_wanita'  => 'required|string',
            'tempat_lahir_wanita'   => 'required|string|max:100',
            'tanggal_lahir_wanita'  => 'required|date',
            'agama_wanita'          => 'required|string',
            'pekerjaan_wanita'      => 'required|string|max:100',
            'desa_wanita'           => 'required|string',
            'desa_wanita_lainnya'   => 'nullable|string|max:100', // Input tambahan jika pilih "Lainnya"
            'alamat_wanita'         => 'required|string',
        ]);

        $dataToStore = $validated;

        if ($request->hasFile('file_surat_kua')) {
            $request->validate([
                'file_surat_kua' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120'
            ]);
            if ($dispensasi_nikah->file_surat_kua && Storage::exists($dispensasi_nikah->file_surat_kua)) {
                Storage::delete($dispensasi_nikah->file_surat_kua);
                // dd('berhasil menghapus');
            }
            $dataToStore['file_surat_kua'] = $request->file('file_surat_kua')->store('dispensasi/surat_kua', 'public');
        } else $dataToStore['file_surat_kua'] = $dispensasi_nikah->file_surat_kua;

        if ($request->hasFile('file_bukti_cerai_pria')) {
            $request->validate([
                'file_bukti_cerai_pria' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120'
            ]);
            if ($dispensasi_nikah->file_bukti_cerai_pria && Storage::exists($dispensasi_nikah->file_bukti_cerai_pria)) {
                Storage::delete($dispensasi_nikah->file_bukti_cerai_pria);
                // dd('berhasil menghapus');
            }
            $dataToStore['file_bukti_cerai_pria'] = $request->file('file_bukti_cerai_pria')->store('dispensasi/bukti_cerai', 'public');
        } else $dataToStore['file_bukti_cerai_pria'] = $dispensasi_nikah->file_bukti_cerai_pria;

        if ($request->hasFile('file_bukti_cerai_wanita')) {
            $request->validate([
                'file_bukti_cerai_wanita' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120'
            ]);
            if ($dispensasi_nikah->file_bukti_cerai_wanita && Storage::exists($dispensasi_nikah->file_bukti_cerai_wanita)) {
                Storage::delete($dispensasi_nikah->file_bukti_cerai_wanita);
            }
            $dataToStore['file_bukti_cerai_wanita'] = $request->file('file_bukti_cerai_wanita')->store('dispensasi/bukti_cerai', 'public');
        } else $dataToStore['file_bukti_cerai_wanita'] = $dispensasi_nikah->file_bukti_cerai_wanita;

        $dataToStore['pernah_nikah_pria'] = $request->hasFile('file_bukti_cerai_pria');
        $dataToStore['pernah_nikah_wanita'] = $request->hasFile('file_bukti_cerai_wanita');

        $dispensasi_nikah->update($dataToStore);
        return redirect('/admin/dispensasi-nikah')->with('berhasil', 'berhasil mengubah data');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }
        $dispensasiNikah = DispensasiNikah::findOrFail($id);

        if ($dispensasiNikah->file_surat_kua) {

            Storage::delete($dispensasiNikah->file_surat_kua);
        }

        if ($dispensasiNikah->file_bukti_cerai_pria) {

            Storage::delete($dispensasiNikah->file_bukti_cerai_pria);
        }

        if ($dispensasiNikah->file_bukti_cerai_wanita) {

            Storage::delete($dispensasiNikah->file_bukti_cerai_wanita);
        }

        if ($dispensasiNikah->file_dn_selesai) {

            Storage::delete($dispensasiNikah->file_dn_selesai);
        }


        $dispensasiNikah->delete();

        return redirect()->route('admin.dispensasi.index')->with('berhasil', 'menghapus data');
    }

    public function generateSuratPDF($id)
    {
        $data = DispensasiNikah::findOrFail($id);

        $pdf = Pdf::loadView('pdf.surat_dispensasi', [
            'data' => $data
        ]);

        // return $pdf->download('surat_dispensasi_' . $data->id . '.pdf');
        return $pdf->stream('surat_dispensasi_' . $data->id . '.pdf');
    }
}
