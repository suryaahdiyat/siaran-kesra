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

            <form action="{{ route('admin.rimd2.update', $rimd->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Surat Keluar > Edit Data Rekomendasi Izin Mencari Dana</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required
                            value="{{ old('nomor_surat', $rimd->nomor_surat) }}">
                    </div>
                    <div class="mb-4 col-12">
                        <label for="file_rimd_after" class="form-label">File RIMD Selesai (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_rimd_after" name="file_rimd_after">
                    </div>
                </div>
                <hr>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('admin.rimd2.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
