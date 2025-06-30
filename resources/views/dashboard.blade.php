{{-- Menggunakan master layout dari layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Mengisi bagian konten --}}
@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-gray-800 h3">Beranda</h1>
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="mb-3 row">
                <div class="col-md-3">
                    <label>Bulan</label>
                    <select name="bulan" class="form-select">
                        <option value="">-- Semua Bulan --</option>
                        @foreach (range(1, 12) as $bulan)
                            <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">-- Semua Tahun --</option>
                        @foreach (range(now()->year, 2020) as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>


        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang!</h6>
            </div>
            <div class="card-body">
                <p>
                    Halo, **{{ Auth::user()->name }}**! Anda telah berhasil login ke dalam Sistem Informasi Arsip
                    Kesejahteraan Rakyat (SIARAN KESRA).
                </p>
                <p>
                    Peran Anda saat ini adalah: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                </p>
                <p class="mb-0">
                    Silakan gunakan menu di sebelah kiri untuk menavigasi sistem.
                </p>
            </div>
        </div>

        {{-- Anda bisa menambahkan konten dashboard lain di sini, seperti statistik --}}
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3 text-white card bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Surat Masuk</h5>
                        <p class="card-text fs-3">{{ $jumlahSuratMasuk }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3 text-white card bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Surat Keluar</h5>
                        <p class="card-text fs-3">{{ $jumlahSuratKeluar }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Surat Dispensasi Nikah Masuk per Desa</h3>

                <canvas id="dnMChart" width="400" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <h3 class="mb-4">Surat Dispensasi Nikah Keluar per Desa</h3>

                <canvas id="dnKChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Surat SKTM per Desa</h3>

                <canvas id="sktmChart" width="400" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <h3 class="mb-4">Surat RIMD per Desa</h3>

                <canvas id="rimdChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Surat LIOB per Desa</h3>

                <canvas id="liobChart" width="400" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <h3 class="mb-4">Surat RIUMK per Desa</h3>

                <canvas id="riumkChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Surat LRP per Desa</h3>

                <canvas id="lrpChart" width="400" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <h3 class="mb-4">Surat RKSU per Desa</h3>

                <canvas id="rskuChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Surat RBK per Desa</h3>

                <canvas id="rbkChart" width="400" height="200"></canvas>
            </div>
            <div class="col-md-6">
                <h3 class="mb-4">Surat Lainnya per Desa</h3>

                <canvas id="slChart" width="400" height="200"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <canvas id="sktmChart"></canvas> --}}

    <script>
        const listDesa = [
            'sungai_ramania',
            'tanipah',
            'terantang',
            'tatah_alayung',
            'tabing_rimbah',
            'antasan_segera',
            'bangkit_baru',
            'puntik_luar',
            'puntik_tengah',
            'puntik_dalam',
            'pantai_hambawang',
            'karang_indah',
            'karang_bunga',
            'lokrawa'
        ];
        const labels = listDesa.map(function(desa) {
            return desa
                .replace(/_/g, ' ') // Ganti _ dengan spasi
                .replace(/\b\w/g, function(char) { // Kapital setiap kata
                    return char.toUpperCase();
                });
        });
        // console.log('Labels:', labels);
    </script>

    <script>
        const listDesa2 = [
            'sungai_ramania',
            'tanipah',
            'terantang',
            'tatah_alayung',
            'tabing_rimbah',
            'antasan_segera',
            'bangkit_baru',
            'puntik_luar',
            'puntik_tengah',
            'puntik_dalam',
            'pantai_hambawang',
            'karang_indah',
            'karang_bunga',
            'lokrawa',
            'lainnya'
        ];
        const labels2 = listDesa2.map(function(desa) {
            return desa
                .replace(/_/g, ' ') // Ganti _ dengan spasi
                .replace(/\b\w/g, function(char) { // Kapital setiap kata
                    return char.toUpperCase();
                });
        });
        const dMPria = listDesa2.map(d => (@json($dMPria)[d] ?? 0));
        const dMWanita = listDesa2.map(d => (@json($dMWanita)[d] ?? 0));

        const ctxMDn = document.getElementById('dnMChart').getContext('2d');
        const chartMDn = new Chart(ctxMDn, {
            type: 'bar',
            data: {
                labels: labels2,
                datasets: [{
                        label: 'Mempelai Pria',
                        data: dMPria,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mempelai Wanita',
                        data: dMWanita,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        const dKPria = listDesa2.map(d => (@json($dKPria)[d] ?? 0));
        const dKWanita = listDesa2.map(d => (@json($dKWanita)[d] ?? 0));

        const ctxKDn = document.getElementById('dnKChart').getContext('2d');
        const chartKDn = new Chart(ctxKDn, {
            type: 'bar',
            data: {
                labels: labels2,
                datasets: [{
                        label: 'Mempelai Pria',
                        data: dKPria,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mempelai Wanita',
                        data: dKWanita,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const sktmMasuk = listDesa.map(d => (@json($sktmMasuk)[d] ?? 0));
        const sktmKeluar = listDesa.map(d => (@json($sktmKeluar)[d] ?? 0));

        const ctxSktm = document.getElementById('sktmChart').getContext('2d');
        const chartSktm = new Chart(ctxSktm, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat SKTM Masuk',
                        data: sktmMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat SKTM Keluar',
                        data: sktmKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const rimdMasuk = listDesa.map(d => (@json($rimdMasuk)[d] ?? 0));
        const rimdKeluar = listDesa.map(d => (@json($rimdKeluar)[d] ?? 0));

        const ctxRimd = document.getElementById('rimdChart').getContext('2d');
        const chartRimd = new Chart(ctxRimd, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat RIMD Masuk',
                        data: rimdMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat RIMD Keluar',
                        data: rimdKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const liobMasuk = listDesa.map(d => (@json($liobMasuk)[d] ?? 0));
        const liobKeluar = listDesa.map(d => (@json($liobKeluar)[d] ?? 0));

        const ctxLiob = document.getElementById('liobChart').getContext('2d');
        const chartLiob = new Chart(ctxLiob, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat LIOB Masuk',
                        data: liobMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat LIOB Keluar',
                        data: liobKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const riumkMasuk = listDesa.map(d => (@json($riumkMasuk)[d] ?? 0));
        const riumkKeluar = listDesa.map(d => (@json($riumkKeluar)[d] ?? 0));

        const ctxRiumk = document.getElementById('riumkChart').getContext('2d');
        const chartRiumk = new Chart(ctxRiumk, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat RIUMK Masuk',
                        data: riumkMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat RIUMK Keluar',
                        data: riumkKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const lrpMasuk = listDesa.map(d => (@json($lrpMasuk)[d] ?? 0));
        const lrpKeluar = listDesa.map(d => (@json($lrpKeluar)[d] ?? 0));

        const ctxLrp = document.getElementById('lrpChart').getContext('2d');
        const chartLrp = new Chart(ctxLrp, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat LRP Masuk',
                        data: lrpMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat LRP Keluar',
                        data: lrpKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const rskuMasuk = listDesa.map(d => (@json($rskuMasuk)[d] ?? 0));
        const rskuKeluar = listDesa.map(d => (@json($rskuKeluar)[d] ?? 0));

        const ctxRsku = document.getElementById('rskuChart').getContext('2d');
        const chartRsku = new Chart(ctxRsku, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat RSKU Masuk',
                        data: rskuMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat RSKU Keluar',
                        data: rskuKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const rbkMasuk = listDesa.map(d => (@json($rbkMasuk)[d] ?? 0));
        const rbkKeluar = listDesa.map(d => (@json($rbkKeluar)[d] ?? 0));

        const ctxRbk = document.getElementById('rbkChart').getContext('2d');
        const chartRbk = new Chart(ctxRbk, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat RBK Masuk',
                        data: rbkMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat RBK Keluar',
                        data: rbkKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const slMasuk = listDesa.map(d => (@json($slMasuk)[d] ?? 0));
        const slKeluar = listDesa.map(d => (@json($slKeluar)[d] ?? 0));

        const ctxSl = document.getElementById('slChart').getContext('2d');
        const chartSl = new Chart(ctxSl, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Surat Lainnya Masuk',
                        data: slMasuk,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Surat Lainnya Keluar',
                        data: slKeluar,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>




    {{-- <script>
        const suratMasukSktm = @json($suratMasukSktm);

        const labelsSMSKTM = listDesa.map(desa => desa.replaceAll('_', ' ').replace(/\b\w/g, l => l.toUpperCase()));
        const dataSMSKTM = listDesa.map(desa => suratMasukSktm[desa]?.total ?? 0);

        const ctxSMSKTM = document.getElementById('sktmMChart').getContext('2d');
        const sktmMChart = new Chart(ctxSMSKTM, {
            type: 'bar',
            data: {
                labels: labelsSMSKTM,
                datasets: [{
                    label: 'Jumlah Surat Masuk (SKTM)',
                    data: dataSMSKTM,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script> --}}
    {{-- <script>
        const suratMasukRimd = @json($suratMasukRimd);

        const labelsSMRIMD = listDesa.map(desa => desa.replaceAll('_', ' ').replace(/\b\w/g, l => l.toUpperCase()));
        const dataSMRIMD = listDesa.map(desa => suratMasukRimd[desa]?.total ?? 0);

        const ctxSMRIMD = document.getElementById('rimdMChart').getContext('2d');
        const rimdMChart = new Chart(ctxSMRIMD, {
            type: 'bar',
            data: {
                labels: labelsSMRIMD,
                datasets: [{
                    label: 'Jumlah Surat Masuk (RIMD)',
                    data: dataSMRIMD,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script> --}}


    {{-- <script>
        const ctx = document.getElementById('sktmChart').getContext('2d');
        const sktmChart = new Chart(ctx, {
            type: 'bar', // Ganti dengan 'bar' untuk grafik batang vertikal atau 'horizontalBar' untuk horizontal
            data: {
                labels: {!! json_encode($suratMasukPerdesaSktm->pluck('nama_desa')->map(fn($d) => ucwords(str_replace('_', ' ', $d)))) !!},
                datasets: [{
                    label: 'Jumlah Surat Masuk',
                    data: {!! json_encode($suratMasukPerdesaSktm->pluck('total')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                // indexAxis: 'y', // Horizontal bar, hilangkan jika ingin vertikal
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script> --}}
@endsection
