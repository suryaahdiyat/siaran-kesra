<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan Dispensasi Nikah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="text-white card-header bg-primary">
                <h3 class="mb-0">Formulir Pengajuan Dispensasi Nikah</h3>
            </div>
            <div class="card-body">
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

                <form action="{{ route('dispensasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h5 class="mb-3">Data Umum</h5>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nomor_surat_kua" class="form-label">Nomor Surat dari KUA</label>
                            <input type="text" class="form-control" id="nomor_surat_kua" name="nomor_surat_kua"
                                required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="tanggal_nikah" class="form-label">Rencana Tanggal Nikah</label>
                            <input type="date" class="form-control" id="tanggal_nikah" name="tanggal_nikah" required>
                        </div>
                        <div class="mb-4 col-12">
                            <label for="file_surat_kua" class="form-label">Upload Surat dari KUA (PDF, JPG, PNG)</label>
                            <input class="form-control" type="file" id="file_surat_kua" name="file_surat_kua"
                                required>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Data Calon Pengantin Laki-laki</h5>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama_pria" class="form-control"
                                    placeholder="Contoh: Fulan bin Fulan" required>
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
                                    <input type="text" name="tempat_lahir_pria" class="form-control" required>
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir_pria" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama_pria" value="Islam" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan_pria" class="form-control" required>
                            </div>
                            <x-dropdown-desa id="desa_pria" label="Desa" name="desa_pria" :isDispensasi="true"
                                required />
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat_pria" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sudah pernah menikah sebelumnya?</label>
                                <div>
                                    <input type="radio" class="btn-check" name="pernah_nikah_pria" id="pria_ya"
                                        value="1" autocomplete="off" onchange="toggleBuktiCerai('pria', true)">
                                    <label class="btn btn-outline-primary" for="pria_ya">Ya</label>
                                    <input type="radio" class="btn-check" name="pernah_nikah_pria" id="pria_tidak"
                                        value="0" autocomplete="off" onchange="toggleBuktiCerai('pria', false)"
                                        checked>
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
                                    placeholder="Contoh: Fulanah binti Fulan" required>
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
                                    <input type="text" name="tempat_lahir_wanita" class="form-control" required>
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir_wanita" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama_wanita" value="Islam" class="form-control"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan_wanita" class="form-control" required>
                            </div>
                            <x-dropdown-desa id="desa_wanita" label="Desa" name="desa_wanita" :isDispensasi="true"
                                required />
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat_wanita" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sudah pernah menikah sebelumnya?</label>
                                <div>
                                    <input type="radio" class="btn-check" name="pernah_nikah_wanita"
                                        id="wanita_ya" value="1" autocomplete="off"
                                        onchange="toggleBuktiCerai('wanita', true)">
                                    <label class="btn btn-outline-primary" for="wanita_ya">Ya</label>
                                    <input type="radio" class="btn-check" name="pernah_nikah_wanita"
                                        id="wanita_tidak" value="0" autocomplete="off"
                                        onchange="toggleBuktiCerai('wanita', false)" checked>
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
                        <a href="/" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
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
</body>

</html>
