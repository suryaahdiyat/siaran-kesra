{{-- <!DOCTYPE html>
<html>

<head>
    <title>Surat Dispensasi Nikah</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin: 20px;
        }

        .ttd {
            text-align: right;
            margin-top: 50px;
            margin-right: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>SURAT DISPENSASI NIKAH</h2>
        <p>Nomor: {{ $data->nomor_surat_kua }}</p>
    </div>

    <div class="section">
        <p>Telah mengajukan dispensasi nikah atas nama:</p>

        <p><strong>Pria:</strong> {{ $data->nama_pria }} - {{ $data->tempat_lahir_pria }},
            {{ \Carbon\Carbon::parse($data->tanggal_lahir_pria)->translatedFormat('d F Y') }}</p>
        <p><strong>Wanita:</strong> {{ $data->nama_wanita }} - {{ $data->tempat_lahir_wanita }},
            {{ \Carbon\Carbon::parse($data->tanggal_lahir_wanita)->translatedFormat('d F Y') }}</p>

        <p>Tanggal Rencana Nikah:
            <strong>{{ \Carbon\Carbon::parse($data->tanggal_nikah)->translatedFormat('d F Y') }}</strong></p>

        <p>Demikian surat ini dibuat untuk digunakan sebagaimana mestinya.</p>
    </div>

    <div class="ttd">
        <p>{{ now()->translatedFormat('d F Y') }}</p>
        <p><strong>Kepala KUA</strong></p><br><br><br>
        <p><strong>_____________________</strong></p>
    </div>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Dispensasi Nikah</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12pt;
        }

        table {
            width: 100%;
        }

        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 10px;
        }

        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .identitas td {
            padding: 3px 5px;
            vertical-align: top;
        }

        .ttd {
            text-align: right;
            margin-top: 30px;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif">
    {{-- KOP SURAT --}}

    {{-- KOP SURAT --}}
    <table width="100%" style="border-bottom: 4px solid black; padding-bottom: 3px; margin-bottom: 20px;">
        <tr>
            <td width="15%" align="center">
                <img src="{{ public_path('images/Lambang_Kabupaten_Barito_Kuala.png') }}" alt="Logo" width="100">
            </td>
            <td width="85%" align="center">
                <h3 style="margin: 0; font-size: 20pt;">PEMERINTAH KABUPATEN BARITO KUALA</h3>
                <h3 style="margin: 0; font-size: 20pt;">KECAMATAN MANDASTANA</h3>
                <p style="margin: 0; font-size: 12pt;">Jl. Tabing Rimbah No. 03 RT. 07, Mandastana 70581</p>
            </td>
        </tr>
    </table>

    <div class="judul-surat">SURAT DISPENSASI NIKAH</div>
    <div class="nomor-surat">NOMOR : 474.2/ &nbsp; &nbsp; &nbsp; / Mdt / </div>

    <p style="text-align: justify">
        &nbsp; &nbsp; Yang bertanda tangan di bawah ini, atas nama Camat Mandastana, Kasi Kesra dan Pelayanan Kecamatan
        Mandastana
        Kabupaten Barito Kuala, berdasarkan surat Kepala Kantor Urusan Agama Kecamatan Mandastana Nomor:
        {{ $data->nomor_surat_kua }} tanggal
        {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }},
        tentang Permohonan Surat Dispensasi Nikah atas nama:
        {{ $data->nama_pria }}
        dengan
        {{ $data->nama_wanita }}
        dengan ini diberikan Dispensasi Percepatan Pelaksanaan Akad Nikah.
    </p>

    {{-- IDENTITAS PRIA --}}


    {{-- IDENTITAS PRIA --}}
    <table class="identitas" width="100%" style="margin-top: 15px;margin-left: 45px">
        <tr>
            <td width="30%">Nama</td>
            <td width="5%">:</td>
            <td>{{ $data->nama_pria }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>Laki-laki</td>
        </tr>
        <tr>
            <td>Tempat / Tgl. Lahir</td>
            <td>:</td>
            <td>{{ $data->tempat_lahir_pria }},
                {{ \Carbon\Carbon::parse($data->tanggal_lahir_pria)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $data->agama_pria }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->pekerjaan_pria }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat_pria }}</td>
        </tr>
    </table>

    <p style="margin-top: 10px;">Akan menikah dengan seorang :</p>

    {{-- IDENTITAS WANITA --}}
    <table class="identitas" width="100%" style="margin-left: 45px">
        <tr>
            <td width="30%">Nama</td>
            <td width="5%">:</td>
            <td>{{ $data->nama_wanita }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>Perempuan</td>
        </tr>
        <tr>
            <td>Tempat / Tgl. Lahir</td>
            <td>:</td>
            <td>{{ $data->tempat_lahir_wanita }},
                {{ \Carbon\Carbon::parse($data->tanggal_lahir_wanita)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $data->agama_wanita }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $data->pekerjaan_wanita }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat_wanita }}</td>
        </tr>
    </table>


    {{-- <table class="identitas" style="margin-top: 15px;">
        <tr>
            <td colspan="2">Nama</td>
            <td>: {{ $data->nama_pria }}</td>
        </tr>
        <tr>
            <td colspan="2">Jenis Kelamin</td>
            <td>: Laki-laki</td>
        </tr>
        <tr>
            <td colspan="2">Tempat / Tgl. Lahir</td>
            <td>: {{ $data->tempat_lahir_pria }},
                {{ \Carbon\Carbon::parse($data->tanggal_lahir_pria)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="2">Agama</td>
            <td>: {{ $data->agama_pria }}</td>
        </tr>
        <tr>
            <td colspan="2">Pekerjaan</td>
            <td>: {{ $data->pekerjaan_pria }}</td>
        </tr>
        <tr>
            <td colspan="2">Alamat</td>
            <td>: {{ $data->alamat_pria }}</td>
        </tr>
    </table> --}}

    {{-- <p style="margin-top: 10px;">Akan menikah dengan seorang :</p> --}}

    {{-- IDENTITAS WANITA --}}
    {{-- <table class="identitas">
        <tr>
            <td colspan="2">Nama</td>
            <td>: {{ $data->nama_wanita }}</td>
        </tr>
        <tr>
            <td colspan="2">Jenis Kelamin</td>
            <td>: Perempuan</td>
        </tr>
        <tr>
            <td colspan="2">Tempat / Tgl. Lahir</td>
            <td>: {{ $data->tempat_lahir_wanita }},
                {{ \Carbon\Carbon::parse($data->tanggal_lahir_wanita)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="2">Agama</td>
            <td>: {{ $data->agama_wanita }}</td>
        </tr>
        <tr>
            <td colspan="2">Pekerjaan</td>
            <td>: {{ $data->pekerjaan_wanita }}</td>
        </tr>
        <tr>
            <td colspan="2">Alamat</td>
            <td>: {{ $data->alamat_wanita }}</td>
        </tr>
    </table> --}}

    <p style="margin-top: 15px;text-align: justify">
        &nbsp; &nbsp; Sepanjang tidak mengurangi ketentuan-ketentuan yang berlaku Tata Cara Percepatan Nikah /
        Perkawinan berdasarkan
        pasal 3 Peraturan Pemerintah RI Nomor : 9 tahun 1975 tentang Perkawinan, Akad Nikah dapat dilaksanakan pada Hari
        <strong>{{ \Carbon\Carbon::parse($data->tanggal_nikah)->translatedFormat('d F Y') }}</strong>.
    </p>

    <p>&nbsp; &nbsp; Demikian surat ini diberikan kepada yang bersangkutan untuk dapat digunakan sebagaimana mestinya.
    </p>

    {{-- TTD --}}
    {{-- <div class="ttd">
        <p>Dibuat di : Mandastana<br>
            Pada tanggal : {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </p>
        <p><strong>CAMAT MANDASTANA</strong></p><br><br><br>
        <p><strong>____________________</strong></p>
    </div> --}}

    <table style="width: 40%;float: right;">
        <tr>
            <td>Dibuat Di</td>
            <td>: Mandastana</td>
        </tr>
        <tr style="">
            <td>Pada Tanggal</td>
            <td>: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center; border-top: 1px solid black" colspan="2"><strong> Camat Mandastana
                </strong></td>
        </tr>
    </table>
</body>

</html>
