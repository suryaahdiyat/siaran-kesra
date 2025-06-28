@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-2 text-gray-800 h3">Surat Keluar > Data Pengajuan Dispensasi Nikah</h1>
        <p class="mb-4">Daftar semua pengajuan dispensasi nikah yang masuk melalui sistem.</p>

        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <form action="{{ route('admin.dispensasi2.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama catin/ alamat..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
                <h6 class="m-0 font-weight-bold text-primary">Tabel Dispensasi Nikah</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nomor Surat</th>
                                <th>Nama Catin L</th>
                                <th>Nama Catin P</th>
                                <th>Alamat L</th>
                                <th>Alamat P</th>
                                <th>Surat DN</th>
                                <th>Surat DN Selesai</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-truncate" style="max-width: 100px;">{{ $item->nama_pria }}</td>
                                    <td class="text-truncate" style="max-width: 100px;">{{ $item->nama_wanita }}</td>
                                    <td class="text-truncate" style="max-width: 100px;">{{ $item->alamat_pria }}</td>
                                    <td class="text-truncate" style="max-width: 100px;">{{ $item->alamat_wanita }}</td>
                                    <td class="text-truncate" style="max-width: 70px;">
                                        {{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dispensasi.generatePDF', $item->id) }}"
                                            class="btn btn-sm btn-warning" title="Unduh Surat Dispensasi">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if (!empty($item->file_dn_selesai))
                                            <a href="{{ asset('storage/' . $item->file_dn_selesai) }}" target="_blank"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-download"></i> Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">Belum tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->file_dn_selesai_uploaded_at
                                            ? \Carbon\Carbon::parse($item->file_dn_selesai_uploaded_at)->translatedFormat('d F Y')
                                            : '-' }}
                                    </td>

                                    <td class="text-center justify-content-evenly d-flex">
                                        {{-- Tombol aksi lain seperti edit/hapus bisa ditambahkan di sini --}}
                                        <a href="{{ route('admin.dispensasi2.edit', $item->id) }}"
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
                                    <td colspan="10" class="text-center">Belum ada data pengajuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
