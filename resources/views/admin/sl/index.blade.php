@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-2 text-gray-800 h3">Surat Masuk > Surat Lainnya</h1>
        <p class="mb-4">Daftar semua permohonan Surat Lainnya yang masuk melalui sistem.</p>

        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <form action="{{ route('admin.sl.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari jenis surat/ nama pengantar/ desa..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
                @role('staff')
                    <a href="{{ route('admin.sl.create') }}" class="m-0 font-weight-bold text-primary">Tambah data</a>
                @endrole
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Surat</th>
                                <th>Nama Pengantar</th>
                                {{-- <th>Alamat Pengantar</th> --}}
                                <th>Desa Asal</th>
                                <th>File SL</th>
                                <th>Tanggal Upload</th>
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
                                    <td>{{ $item->jenis_surat }}</td>
                                    <td>{{ $item->nama_pengantar }}</td>
                                    {{-- <td>{{ $item->alamat_pengantar }}</td> --}}
                                    <td>{{ ucwords(str_replace('_', ' ', $item->nama_desa)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $item->file_sl_before) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-download"></i> Lihat
                                        </a>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>

                                    @role('staff')
                                        <td class="text-center justify-content-evenly d-flex">
                                            <a href="{{ route('admin.sl.edit', $item->id) }}"
                                                class="btn btn-sm btn-secondary">Edit</a>
                                            <form action="{{ route('admin.sl.destroy', $item->id) }}" method="POST">
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
                                    <td colspan="8" class="text-center">Belum ada data pengajuan.</td>
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
