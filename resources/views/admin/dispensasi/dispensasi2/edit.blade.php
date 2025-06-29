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

            <form action="{{ route('admin.dispensasi2.update', $dispensasi->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Surat Keluar > Edit Dispensasi Nikah</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required
                            value="{{ old('nomor_surat', $dispensasi->nomor_surat) }}">
                    </div>
                    <div class="mb-4 col-6">
                        <label for="file_dn_selesai" class="form-label">File Dispensasi Nikah Selesai (PDF, JPG,
                            PNG)</label>
                        <input class="form-control" type="file" id="file_dn_selesai" name="file_dn_selesai">
                    </div>
                </div>
                <hr>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('admin.dispensasi2.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
