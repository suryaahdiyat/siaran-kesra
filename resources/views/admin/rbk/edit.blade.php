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

            <form action="{{ route('admin.rbk.update', $rbk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Surat Keluar > Edit Data Rekomendasi Bantuan Keagamaan</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_pengantar" class="form-label">Nama Pengantar</label>
                        <input type="text" class="form-control" id="nama_pengantar" name="nama_pengantar" required
                            value="{{ old('nama_pengantar', $rbk->nama_pengantar) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat_pengantar" class="form-label">Alamat Pengantar</label>
                        <input type="text" class="form-control" id="alamat_pengantar" name="alamat_pengantar" required
                            value="{{ old('alamat_pengantar', $rbk->alamat_pengantar) }}">
                    </div>
                    <x-dropdown-desa id="nama_desa" label="Nama Desa" :selected="old('nama_desa', $rbk->nama_desa)" required />
                    <div class="mb-4 col-md-6">
                        <label for="file_rbk_before" class="form-label">File RBK (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_rbk_before" name="file_rbk_before">
                    </div>

                    <hr>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('admin.rbk.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </form>

        </div>
    </div>
@endsection
