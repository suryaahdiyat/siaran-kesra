@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.rsku.update', $rsku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Surat Keluar > Edit Data Legalisasi & Rekomendasi Proposal</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_pengantar" class="form-label">Nama Pengantar</label>
                        <input type="text" class="form-control" id="nama_pengantar" name="nama_pengantar" required
                            value="{{ old('nama_pengantar', $rsku->nama_pengantar) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat_pengantar" class="form-label">Alamat Pengantar</label>
                        <input type="text" class="form-control" id="alamat_pengantar" name="alamat_pengantar" required
                            value="{{ old('alamat_pengantar', $rsku->alamat_pengantar) }}">
                    </div>
                    <div class="mb-4 col-12">
                        <label for="file_rsku_before" class="form-label">File RSKU (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_rsku_before" name="file_rsku_before">
                    </div>

                    <hr>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('admin.rsku.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                    </div>
            </form>

        </div>
    </div>
@endsection
