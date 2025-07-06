@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-2 text-gray-800 h3">Surat Keluar > Legalisasi Izin Orang Banyak</h1>
        <p class="mb-4">Daftar semua permohonan Legalisasi Izin Orang Banyak yang masuk melalui sistem.</p>

        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <form action="{{ route('admin.liob2.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama pengantar/ alamat..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pengantar</th>
                                <th>Nomor Surat</th>
                                <th>Alamat Pengantar</th>
                                <th>File RIMD</th>
                                <th>Tanggal Upload</th>
                                <th>File RIMD Selesai</th>
                                <th>Tanggal Upload Selesai</th>
                                @role('staff')
                                    <th>Aksi</th>
                                @endrole
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pengantar }}</td>
                                    <td>{{ $item->nomor_surat ?? '-' }}</td>
                                    <td>{{ $item->alamat_pengantar }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $item->file_liob_before) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-download"></i> Lihat
                                        </a>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        @if (!empty($item->file_liob_after))
                                            <a href="{{ asset('storage/' . $item->file_liob_after) }}" target="_blank"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-download"></i> Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">Belum tersedia</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $item->file_liob_after_uploaded_at
                                            ? \Carbon\Carbon::parse($item->file_liob_after_uploaded_at)->translatedFormat('d F Y')
                                            : '-' }}
                                    </td>

                                    @role('staff')
                                        <td class="text-center justify-content-evenly d-flex">
                                            <a href="{{ route('admin.liob2.edit', $item->id) }}"
                                                class="btn btn-sm btn-secondary">Edit</a>
                                            <form action="{{ route('admin.liob.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('hapus data ini?')"
                                                    class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    @endrole

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada data pengajuan.</td>
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
