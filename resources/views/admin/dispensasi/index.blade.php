@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-2 text-gray-800 h3">Data Pengajuan Dispensasi Nikah</h1>
        <p class="mb-4">Daftar semua pengajuan dispensasi nikah yang masuk melalui sistem.</p>

        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Dispensasi Nikah</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Catin L</th>
                                <th>Nama Catin P</th>
                                <th>Alamat</th>
                                <th>Tanggal Upload</th>
                                <th>Surat dari KUA</th>
                                <th>Surat DN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataDispensasi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pria }}</td>
                                    <td>{{ $item->nama_wanita }}</td>
                                    <td>{{ $item->alamat_pria }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $item->file_surat_kua) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-download"></i> Lihat
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('dispensasi.generatePDF', $item->id) }}"
                                            class="btn btn-sm btn-warning" title="Unduh Surat Dispensasi">
                                            <i class="bi bi-printer"></i> Generate
                                        </a>
                                    </td>

                                    <td class="text-center justify-content-evenly d-flex">
                                        {{-- Tombol aksi lain seperti edit/hapus bisa ditambahkan di sini --}}
                                        <a href="{{ route('admin.dispensasi.edit', $item->id) }}"
                                            class="btn btn-sm btn-secondary">Edit</a>
                                        <form action="{{ route('admin.dispensasi.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('hapus data ini?')"
                                                class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data pengajuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
