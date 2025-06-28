@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-2 text-gray-800 h3">Surat Masuk > Data Pengajuan Dispensasi Nikah</h1>
        <p class="mb-4">Daftar semua pengajuan dispensasi nikah yang masuk melalui sistem.</p>

        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <form action="{{ route('admin.dispensasi.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama catin/ desa..."
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
                                <th>Nama Catin L</th>
                                <th>Nama Catin P</th>
                                <th>Desa L</th>
                                <th>Desa P</th>
                                {{-- <th>Alamat L</th> --}}
                                {{-- <th>Alamat P</th> --}}
                                <th>Tanggal Upload</th>
                                <th>Surat DN</th>
                                <th>Surat dari KUA</th>
                                <th>Status Nikah L</th>
                                <th>Status Nikah P</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-truncate" style="max-width: 100px;">{{ $item->nama_pria }}</td>
                                    <td class="text-truncate" style="max-width: 100px;">{{ $item->nama_wanita }}</td>
                                    <td class="text-center">
                                        {{ $item->desa_pria_lainnya ? $item->desa_pria_lainnya : ucwords(str_replace('_', ' ', $item->desa_pria)) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->desa_wanita_lainnya ? $item->desa_wanita_lainnya : ucwords(str_replace('_', ' ', $item->desa_wanita)) }}
                                    </td>
                                    {{-- <td class="text-truncate" style="max-width: 100px;">{{ $item->alamat_pria }}</td> --}}
                                    {{-- <td class="text-truncate" style="max-width: 100px;">{{ $item->alamat_wanita }}</td> --}}
                                    <td class="text-truncate" style="max-width: 70px;">
                                        {{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dispensasi.generatePDF', $item->id) }}"
                                            class="btn btn-sm btn-warning" title="Unduh Surat Dispensasi">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $item->file_surat_kua) }}" target="_blank"
                                            class="btn btn-sm btn-info" title="Lihat Surat KUA">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">

                                        @if ($item->file_bukti_cerai_pria)
                                            <a href="{{ asset('storage/' . $item->file_bukti_cerai_pria) }}"
                                                target="_blank" class="btn btn-sm btn-info" title="Lihat Bukti Cerai Pria">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Belum Nikah</span>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        @if ($item->file_bukti_cerai_wanita)
                                            <a href="{{ asset('storage/' . $item->file_bukti_cerai_wanita) }}"
                                                target="_blank" class="btn btn-sm btn-info"
                                                title="Lihat Bukti Cerai Wanita">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Belum Nikah</span>
                                        @endif
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
                                    <td colspan="11" class="text-center">Belum ada data pengajuan.</td>
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
