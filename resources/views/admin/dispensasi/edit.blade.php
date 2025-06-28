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

            <form action="{{ route('admin.dispensasi.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="mb-3">Update Data Surat Permohonan Dispensasi Nikah</h5>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nomor_surat_kua" class="form-label">Nomor Surat dari KUA</label>
                        <input type="text" class="form-control" id="nomor_surat_kua" name="nomor_surat_kua" required
                            value="{{ old('nomor_surat_kua', $data->nomor_surat_kua) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="tanggal_nikah" class="form-label">Rencana Tanggal Nikah</label>
                        <input type="date" class="form-control" id="tanggal_nikah" name="tanggal_nikah" required
                            value="{{ old('tanggal_nikah', \Carbon\Carbon::parse($data->tanggal_nikah)->format('Y-m-d')) }}">
                    </div>
                    <div class="mb-4 col-12">
                        <label for="file_surat_kua" class="form-label">Upload Surat dari KUA (PDF, JPG, PNG)</label>
                        <input class="form-control" type="file" id="file_surat_kua" name="file_surat_kua">
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Data Calon Pengantin Laki-laki</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama_pria" class="form-control"
                                placeholder="Contoh: Fulan bin Fulan" required
                                value="{{ old('nama_pria', $data->nama_pria) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin_pria" class="form-select" readonly>
                                <option value="Laki-laki" selected>Laki-laki</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_pria" class="form-control" required
                                    value="{{ old('tempat_lahir_pria', $data->tempat_lahir_pria) }}">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_pria" class="form-control" required
                                    value="{{ old('tanggal_lahir_pria', \Carbon\Carbon::parse($data->tanggal_lahir_pria)->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <input type="text" name="agama_pria" value="Islam" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan_pria" class="form-control" required
                                value="{{ old('pekerjaan_pria', $data->pekerjaan_pria) }}">
                        </div>
                        <x-dropdown-desa id="desa_pria" label="Desa Pria" :selected="old('desa_pria', $data->desa_pria)" :isDispensasi="true" required />

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat_pria" class="form-control" rows="3" required>{{ old('alamat_pria', $data->alamat_pria) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sudah pernah menikah sebelumnya?</label>
                            <div>
                                <input type="radio" class="btn-check" name="pernah_nikah_pria" id="pria_ya"
                                    value="1" autocomplete="off" onchange="toggleBuktiCerai('pria', true)">
                                <label class="btn btn-outline-primary" for="pria_ya">Ya</label>
                                <input type="radio" class="btn-check" name="pernah_nikah_pria" id="pria_tidak"
                                    value="0" autocomplete="off" onchange="toggleBuktiCerai('pria', false)" checked>
                                <label class="btn btn-outline-secondary" for="pria_tidak">Tidak</label>
                            </div>
                        </div>
                        <div class="mb-3" id="bukti_cerai_pria_div" style="display: none;">
                            <label class="form-label">Upload Bukti Cerai / Izin Menikah Lagi</label>
                            <input class="form-control" type="file" name="file_bukti_cerai_pria">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Data Calon Pengantin Perempuan</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama_wanita" class="form-control"
                                placeholder="Contoh: Fulanah binti Fulan" required
                                value="{{ old('nama_wanita', $data->nama_wanita) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin_wanita" class="form-select" readonly>
                                <option value="Perempuan" selected>Perempuan</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_wanita" class="form-control" required
                                    value="{{ old('tempat_lahir_wanita', $data->tempat_lahir_wanita) }}">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_wanita" class="form-control" required
                                    value="{{ old('tanggal_lahir_wanita', \Carbon\Carbon::parse($data->tanggal_lahir_wanita)->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <input type="text" name="agama_wanita" value="Islam" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan_wanita" class="form-control" required
                                value="{{ old('pekerjaan_wanita', $data->pekerjaan_wanita) }}">
                        </div>
                        <x-dropdown-desa id="desa_wanita" label="Desa Wanita" :selected="old('desa_wanita', $data->desa_wanita)" :isDispensasi="true"
                            required />

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat_wanita" class="form-control" rows="3" required>{{ old('alamat_wanita', $data->alamat_wanita) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sudah pernah menikah sebelumnya?</label>
                            <div>
                                <input type="radio" class="btn-check" name="pernah_nikah_wanita" id="wanita_ya"
                                    value="1" autocomplete="off" onchange="toggleBuktiCerai('wanita', true)">
                                <label class="btn btn-outline-primary" for="wanita_ya">Ya</label>
                                <input type="radio" class="btn-check" name="pernah_nikah_wanita" id="wanita_tidak"
                                    value="0" autocomplete="off" onchange="toggleBuktiCerai('wanita', false)"
                                    checked>
                                <label class="btn btn-outline-secondary" for="wanita_tidak">Tidak</label>
                            </div>
                        </div>
                        <div class="mb-3" id="bukti_cerai_wanita_div" style="display: none;">
                            <label class="form-label">Upload Bukti Cerai / Izin Menikah Lagi</label>
                            <input class="form-control" type="file" name="file_bukti_cerai_wanita">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="/admin/dispensasi-nikah" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function toggleBuktiCerai(gender, show) {
            const div = document.getElementById(`bukti_cerai_${gender}_div`);
            if (show) {
                div.style.display = 'block';
            } else {
                div.style.display = 'none';
            }
        }
    </script>
@endsection
