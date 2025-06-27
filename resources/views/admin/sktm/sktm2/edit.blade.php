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

            <form action="{{ route('admin.sktm2.update', $sktm->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Surat Keluar > Edit Data Surat Keterangan Tidak Mampu</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required
                            value="{{ old('nomor_surat', $sktm->nomor_surat) }}">
                    </div>
                    <div class="mb-4 col-12">
                        <label for="file_sktm_after" class="form-label">File SKTM Selesai (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_sktm_after" name="file_sktm_after">
                    </div>
                </div>
                <hr>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('admin.sktm2.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
