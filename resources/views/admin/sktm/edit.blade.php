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

            <form action="{{ route('admin.sktm.update', $sktm->id) }}" method="POST" enctype="multipart/form-sktm">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Edit Data Surat Keterangan Tidak Mampu</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama_pengantar" class="form-label">Nama Pengantar</label>
                        <input type="text" class="form-control" id="nama_pengantar" name="nama_pengantar" required
                            value="{{ old('nama_pengantar', $sktm->nama_pengantar) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="alamat_pengantar" class="form-label">Alamat Pengantar</label>
                        <input type="text" class="form-control" id="alamat_pengantar" name="alamat_pengantar" required
                            value="{{ old('alamat_pengantar', $sktm->alamat_pengantar) }}">
                    </div>
                    {{-- @php
                        $listDesa = [
                            'sungai_ramania' => 'Sungai Ramania',
                            'tanipah' => 'Tanipah',
                            'terantang' => 'Terantang',
                            'tatah_alayung' => 'Tatah Alayung',
                            'tabing_rimbah' => 'Tabing Rimbah',
                            'antasan_segera' => 'Antasan Segera',
                            'bangkit_baru' => 'Bangkit Baru',
                            'puntik_luar' => 'Puntik Luar',
                            'puntik_tengah' => 'Puntik Tengah',
                            'puntik_dalam' => 'Puntik Dalam',
                            'pantai_hambawang' => 'Pantai Hambawang',
                            'karang_indah' => 'Karang Indah',
                            'karang_bunga' => 'Karang Bunga',
                            'lokrawa' => 'Lokrawa',
                        ];
                    @endphp

                    <div class="mb-3 col-md-6">
                        <label for="nama_desa" class="form-label">Nama Desa</label>
                        <select class="form-select" id="nama_desa" name="nama_desa" required>
                            <option value="" disabled>-- Pilih Desa --</option>
                            @foreach ($listDesa as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('nama_desa', $sktm->nama_desa ?? '') === $value ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <x-dropdown-desa id="nama_desa" label="Nama Desa" :selected="old('nama_desa', $sktm->nama_desa)" required />




                    <div class="mb-4 col-md-6">
                        <label for="file_sktm_before" class="form-label">File SKTM (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_sktm_before" name="file_sktm_before">
                    </div>
                </div>
                <hr>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('admin.sktm.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
