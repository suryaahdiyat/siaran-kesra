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

            <form action="{{ route('admin.rbk2.update', $rbk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Surat Keluar > Edit Data Rekomendasi Bantuan Keagamaan</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required
                            value="{{ old('nomor_surat', $rbk->nomor_surat) }}">
                    </div>
                    <div class="mb-4 col-6">
                        <label for="file_rbk_after" class="form-label">File RBK Selesai (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_rbk_after" name="file_rbk_after">
                    </div>
                </div>
                <hr>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('admin.rbk2.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
