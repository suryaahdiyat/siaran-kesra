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

            <form action="{{ route('admin.lrp.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="mb-3">Surat Masuk > Tambah Data Legalisasi & Rekomendasi Proposal</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_pengantar" class="form-label">Nama Pengantar</label>
                        <input type="text" class="form-control" id="nama_pengantar" name="nama_pengantar" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat_pengantar" class="form-label">Alamat Pengantar</label>
                        <input type="text" class="form-control" id="alamat_pengantar" name="alamat_pengantar" required>
                    </div>
                    {{-- <div class="mb-4 col-12">
                        <label for="file_riumk_before" class="form-label">File RIUMK (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_riumk_before" name="file_riumk_before">
                    </div> --}}
                    <div class="mb-4 col-12">
                        <label for="file_lrp_before" class="form-label">File LRP (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_lrp_before" name="file_lrp_before">
                    </div>
                    <hr>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('admin.lrp.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                    </div>
            </form>

        </div>
    </div>
@endsection
