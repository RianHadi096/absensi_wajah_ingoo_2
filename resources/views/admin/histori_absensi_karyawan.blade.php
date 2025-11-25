<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Camera Link-->

<script src="https://cdn.tailwindcss.com"></script>

<head>
    <!-- Add logo page-->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_ingoo_page.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Histori Absensi ({{ session('role') }})</title>
</head>

<style>
    .endpage{
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Height of the footer */
        background-color: #f5f5f5;
    }
    .hide-on-small {
        display: inline;
    }
    .if-table-displays-in-desktop {
        display: inline;
    }
    .if-table-displays-in-mobile {
        display: none;
    }
    
    /* Override Bootstrap 5 pagination text color to black */
    .page-link {
        color: #000 !important;  /* Black text for links */
    }
    .page-link:hover {
        color: #000 !important;  /* Black on hover */
        background-color: #f8f9fa;  /* Optional: Light gray background on hover */
    }
    /* Active page styling */
    .page-item.active .page-link {
        background-color: #000;  /* Black background for active page */
        border-color: #000;
        color: #fff !important;  /* White text on active for contrast */
    }
    .desktop-mode{
        display: inline;
    }
    .mobile-mode{
        display: none;
    }

    @media (max-width: 500px) {
        /* Reduce font sizes for mobile devices */
        body, nav, main, footer, h1, h2, h3, h4, h5, h6, p, a, div, td, th, span, button {
            font-size: 11px !important;
        }
        h1 {
            font-size: 16px !important;
        }
        h2 {
            font-size: 14px !important;
        }
        .btn {
            padding: 0.3rem 0.5rem !important;
            font-size: 10px !important;
        }
        table {
            font-size: 10px !important;
        }
        .hide-on-small {
            display: none;
        }
        .if-table-displays-in-desktop {
            display: none;
        }
        .if-table-displays-in-mobile {
            display: inline;
        }
        .logo-layout{
            padding-left: 70px;
        }
        .desktop-mode{
            display: none;
        }
        .mobile-mode{
            display: inline;
        }
    }
</style>

<body>
    <nav>
        <div class="desktop-mode">
            <div class="container-fluid">
                <div class="d-flex align-items-center">

                    <!--logo Perusahaan -->
                    <div class="flex-fill">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="height:70px;" class="img-fluid">
                    </div>

                    <!-- Center spacer to allow center alignment -->
                    <div class="flex-fill"></div>

                    <!-- Logout button on the right -->
                    <div class="d-flex flex-row-reverse">
                        <a class="btn btn-outline-dark ml-2" href="{{ route('admin/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
                        <div class="dropdown">
                            <button
                                class="btn btn-outline-dark dropdown-toggle"
                                type="button"
                                id="triggerId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                            <i class="fa fa-bars" aria-hidden="true"></i><span class="hide-on-small"> Main Menu </span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="{{ route('admin/export') }}"><i class="fa fa-pencil" aria-hidden="true"></i><i class="fas fa-file-excel"></i> Export Ke Excel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-mode">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="flex-fill"></div>

                    <!--logo Perusahaan -->
                    <div class="logo-layout">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <!-- Logout button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse">
                        <a class="btn btn-outline-dark ml-2" href="{{ route('admin/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
                        <div class="dropdown">
                            <button
                                class="btn btn-outline-dark dropdown-toggle"
                                type="button"
                                id="triggerId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                            <i class="fa fa-bars" aria-hidden="true"></i><span class="hide-on-small"> Main Menu </span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="{{ route('admin/export') }}"><i class="fa fa-pencil" aria-hidden="true"></i><i class="fas fa-file-excel"></i> Export Ke Excel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center">
                <!-- Fetch all data karyawan -->
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center font-bold">Histori Absensi Karyawan</h1>
                        @if (Session::has('message'))
                        <div class="alert alert-success m-3" role="alert"><center>{{ Session::get('message') }}</center></div>
                        @endif
                        <hr class="mt-3 mb-1" />
                        <!-- Filter form: pilih per bulan atau per minggu -->
                        <form method="GET" action="{{ route('histori_absensi_karyawan') }}" class="row g-2 mb-3">
                            <div class="col-auto">
                                <label for="filter_type" class="form-label">Filter</label>
                                <select id="filter_type" name="filter_type" class="form-select">
                                    <option value="">-- Semua --</option>
                                    <option value="month" {{ request('filter_type') == 'month' ? 'selected' : '' }}>Per Bulan</option>
                                    <option value="week" {{ request('filter_type') == 'week' ? 'selected' : '' }}>Per Minggu</option>
                                </select>
                            </div>
                            <div class="col-auto" id="month_input_wrapper" style="display: {{ request('filter_type') == 'month' ? 'block' : 'none' }};">
                                <label for="filter_value_month" class="form-label">Pilih Bulan</label>
                                <input id="filter_value_month" type="month" class="form-control" value="{{ request('filter_type') == 'month' ? request('filter_value') : '' }}" @if(request('filter_type') == 'month') name="filter_value" @else disabled @endif>
                            </div>
                            <div class="col-auto" id="week_input_wrapper" style="display: {{ request('filter_type') == 'week' ? 'block' : 'none' }};">
                                <label for="filter_value_week" class="form-label">Pilih Minggu</label>
                                <input id="filter_value_week" type="week" class="form-control" value="{{ request('filter_type') == 'week' ? request('filter_value') : '' }}" @if(request('filter_type') == 'week') name="filter_value" @else disabled @endif>
                            </div>
                            <div class="col-auto align-self-end">
                                <button type="submit" class="btn btn-outline-primary">Terapkan</button>
                                <a href="{{ route('histori_absensi_karyawan') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </form>

                        <div class="table-responsive">
                            @if(isset($used_next_month) && $used_next_month)
                                <div class="alert alert-info">Menampilkan data bulan berikutnya: <strong>{{ $shown_filter_value }}</strong> karena tidak ada data pada bulan yang dipilih: <strong>{{ $requested_filter_value }}</strong>.</div>
                            @endif
                            @if(isset($no_data_next_month) && $no_data_next_month)
                                <div class="alert alert-warning">Tidak ada data di bulan selanjutnya ({{ $requested_filter_value }} -> {{ \Carbon\Carbon::createFromFormat('Y-m',$requested_filter_value)->addMonth()->format('Y-m') }}).</div>
                            @endif
                            @if(isset($used_next_week) && $used_next_week)
                                <div class="alert alert-info">Menampilkan data minggu berikutnya: <strong>{{ $shown_filter_value_week }}</strong> karena tidak ada data pada minggu yang dipilih: <strong>{{ $requested_filter_value_week }}</strong>.</div>
                            @endif
                            @if(isset($no_data_next_week) && $no_data_next_week)
                                <div class="alert alert-warning">Tidak ada data di minggu selanjutnya ({{ $requested_filter_value_week }}).</div>
                            @endif
                            <div class="if-table-displays-in-mobile">
                                <table id="absensiMobileTable" class="table table-bordered table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th data-sortable="tanggal_absensi">Tanggal Absensi <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_masuk">Jam Masuk <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_keluar">Jam Keluar <span class="sort-indicator"></span></th>
                                            <th data-sortable="status_absensi">Status Absensi <span class="sort-indicator"></span></th>
                                            <th>Koordinat (Google Maps)</th>
                                            <th>Keterangan</th>
                                            <th>Posisi Absensi</th>
                                            <th>Foto Masuk</th>
                                            <th>Foto Keluar</th>
                                            <th>Foto Sakit/Izin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_absensi_karyawan_mobile as $index => $absensi_mobile)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absensi_mobile->nama_karyawan }}</td>
                                            <td>{{ $absensi_mobile->tanggal_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->jam_masuk ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->jam_keluar ?? 'N/A' }}</td>
                                            <td>{{ $absensi_mobile->status_absensi ?? 'N/A'}}</td>
                                            <td>{{ $absensi_mobile->keterangan ?? 'N/A'}}</td>
                                            @if($absensi_mobile->koordinat)
                                                <td><a href="#" class="koordinat-link" data-koordinat="{{ $absensi_mobile->koordinat }}">{{ $absensi_mobile->koordinat }}</a></td>
                                            @else
                                                <td>N/A</td>
                                            @endif
                                            @if($absensi_mobile->koordinat == '-7.0381802,107.7100255')
                                                <td><span class="badge bg-primary">Di Kantor</span></td>
                                            @else
                                                <td><span class="badge bg-danger">Di Luar Kantor</span></td>
                                            @endif
                                            <td>
                                                @if ($absensi_mobile->foto_masuk)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_mobile->foto_masuk) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto saat masuk absensi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absensi_mobile->foto_keluar)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_mobile->foto_keluar) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto saat keluar absensi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absensi_mobile->foto_sakit)
                                                    @if(pathinfo($absensi_mobile->foto_sakit, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/'.$absensi_mobile->foto_sakit) }}" target="_blank" rel="noopener noreferrer" class="btn btn-link">
                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Lihat File PDF
                                                        </a>
                                                    @else
                                                        <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                        <div class="d-flex justify-content-center">
                                                            <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_mobile->foto_sakit) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                        </div>
                                                    @endif
                                                @elseif($absensi_mobile->foto_izin)
                                                    @if(pathinfo($absensi_mobile->foto_izin, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/'.$absensi_mobile->foto_izin) }}" target="_blank" rel="noopener noreferrer" class="btn btn-link">
                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Lihat File PDF
                                                        </a>
                                                    @else
                                                        <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                        <div class="d-flex justify-content-center">
                                                            <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_mobile->foto_izin) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                        </div>
                                                    @endif
                                                @else
                                                    <span>Tidak ada bukti foto saat izin/sakit</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($fetch_data_absensi_karyawan_mobile->total() == 0)
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    @if(isset($no_data_next_month) && $no_data_next_month)
                                                        Tidak ada data di bulan selanjutnya
                                                    @elseif(isset($no_data_next_week) && $no_data_next_week)
                                                        Tidak ada data di minggu selanjutnya
                                                    @else
                                                        Tidak ada data untuk periode yang dipilih
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="if-table-displays-in-desktop">
                                <table id="absensiDesktopTable" class="table table-bordered table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th data-sortable="tanggal_absensi">Tanggal Absensi <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_masuk">Jam Masuk <span class="sort-indicator"></span></th>
                                            <th data-sortable="jam_keluar">Jam Keluar <span class="sort-indicator"></span></th>
                                            <th data-sortable="status_absensi">Status Absensi <span class="sort-indicator"></span></th>
                                            <th>Keterangan</th>
                                            <th>Koordinat (Google Maps)</th>
                                            <th>Posisi Absensi</th>
                                            <th>Foto Masuk</th>
                                            <th>Foto Keluar</th>
                                            <th>Foto Sakit/Izin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_absensi_karyawan_desktop as $index => $absensi_desktop)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absensi_desktop->nama_karyawan ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->tanggal_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->jam_masuk ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->jam_keluar ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->status_absensi ?? 'N/A'}}</td>
                                            <td>{{ $absensi_desktop->keterangan ?? 'N/A'}}</td>
                                            @if($absensi_desktop->koordinat)
                                                <td><a href="#" class="koordinat-link" data-koordinat="{{ $absensi_desktop->koordinat }}">{{ $absensi_desktop->koordinat }}</a></td>
                                            @else
                                                <td>N/A</td>
                                            @endif
                                            @if($absensi_desktop->koordinat == '-7.0381802,107.7100255')
                                                <td><span class="badge bg-primary">Di Kantor</span></td>
                                            @else
                                                <td><span class="badge bg-danger">Di Luar Kantor</span></td>
                                            @endif
                                            <td>
                                                @if ($absensi_desktop->foto_masuk)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_desktop->foto_masuk) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto saat masuk absensi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absensi_desktop->foto_keluar)
                                                    <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                    <div class="d-flex justify-content-center">
                                                        <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_desktop->foto_keluar) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                    </div>
                                                @else
                                                    <span>Tidak ada bukti foto saat keluar absensi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absensi_desktop->foto_sakit)
                                                    @if(pathinfo($absensi_desktop->foto_sakit, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/'.$absensi_desktop->foto_sakit) }}" target="_blank" rel="noopener noreferrer" class="btn btn-link">
                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Lihat File PDF
                                                        </a>
                                                    @else
                                                        <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                        <div class="d-flex justify-content-center">
                                                            <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_desktop->foto_sakit) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                        </div>
                                                    @endif
                                                @elseif($absensi_desktop->foto_izin)
                                                    @if(pathinfo($absensi_desktop->foto_izin, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/'.$absensi_desktop->foto_izin) }}" target="_blank" rel="noopener noreferrer" class="btn btn-link">
                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Lihat File PDF
                                                        </a>
                                                    @else
                                                        <button id="toggleButton" class="btn btn-outline-dark mb-1"><i class="fa fa-file-image-o" aria-hidden="true"></i>Hide/Show</button>
                                                        <div class="d-flex justify-content-center">
                                                            <img id="foto-karyawan" src="{{ asset('storage/'.$absensi_desktop->foto_izin) }}" alt="Foto Karyawan" style="max-width: 100px; max-height: 100px; display:none">
                                                        </div>
                                                    @endif
                                                @else
                                                    <span>Tidak ada bukti foto saat izin/sakit</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($fetch_data_absensi_karyawan_desktop->total() == 0)
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    @if(isset($no_data_next_month) && $no_data_next_month)
                                                        Tidak ada data di bulan selanjutnya
                                                    @elseif(isset($no_data_next_week) && $no_data_next_week)
                                                        Tidak ada data di minggu selanjutnya
                                                    @else
                                                        Tidak ada data untuk periode yang dipilih
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center m-3">
                <div class="if-table-displays-in-mobile">
                    {{ $fetch_data_absensi_karyawan_mobile->links('pagination::bootstrap-5') }}
                </div>
                
                <div class="if-table-displays-in-desktop">
                    {{ $fetch_data_absensi_karyawan_desktop->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>


        <!-- Google Maps Modal -->
        <div class="modal fade" id="koordinatModal" tabindex="-1" aria-labelledby="koordinatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="koordinatModalLabel">Lokasi Absensi (Google Maps)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="koordinatMapContainer" style="width:100%;height:400px;">
                            <iframe id="koordinatMapIframe" src="" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

<script>
    document.querySelectorAll('#toggleButton').forEach(button => {
        button.addEventListener('click', function() {
            const fotoKaryawan = this.nextElementSibling.querySelector('#foto-karyawan');
                if (fotoKaryawan.style.display === 'none' || fotoKaryawan.style.display === '') {
                    fotoKaryawan.style.display = 'block';
                } else {
                    fotoKaryawan.style.display = 'none';
                }
            });
        }
    );

    // Modal for Koordinat Google Maps
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.koordinat-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var koordinat = this.getAttribute('data-koordinat');
                if (koordinat && koordinat !== 'N/A') {
                    var mapUrl = 'https://www.google.com/maps?q=' + encodeURIComponent(koordinat) + '&output=embed';
                    document.getElementById('koordinatMapIframe').src = mapUrl;
                    var modal = new bootstrap.Modal(document.getElementById('koordinatModal'));
                    modal.show();
                }
            });
        });
    });

    // ====================================================================
    // Server-side AJAX sorting for admin (no page refresh)
    // - Click on headers to fetch sorted data from server via AJAX
    // - Updates table body with new sorted rows
    // ====================================================================

    async function fetchSortedAdminData(sortBy, sortOrder, tableType) {
        try {
            console.log('Fetching sorted data:', { sortBy, sortOrder, tableType });
            const url = new URL('{{ route("admin.histori_absensi_ajax") }}', window.location.origin);
            url.searchParams.append('sort_by', sortBy);
            url.searchParams.append('sort_order', sortOrder);
            url.searchParams.append('per_page', tableType === 'mobile' ? 2 : 5);
            // preserve current filter (if any) so AJAX respects month/week filter
            const currentFilterType = document.getElementById('filter_type') ? document.getElementById('filter_type').value : '';
            let currentFilterValue = '';
            if (currentFilterType === 'month') currentFilterValue = document.getElementById('filter_value_month') ? document.getElementById('filter_value_month').value : '';
            if (currentFilterType === 'week') currentFilterValue = document.getElementById('filter_value_week') ? document.getElementById('filter_value_week').value : '';
            if (currentFilterType) url.searchParams.append('filter_type', currentFilterType);
            if (currentFilterValue) url.searchParams.append('filter_value', currentFilterValue);

            console.log('Request URL:', url.toString());
            const response = await fetch(url.toString());
            if (!response.ok) throw new Error('Network response failed: ' + response.status);
            const result = await response.json();

            console.log('Response:', result);
            if (result.success) {
                return result.data;
            } else {
                console.error('Server error:', result);
                alert('Failed to fetch sorted data');
                return null;
            }
        } catch (error) {
            console.error('Fetch error:', error);
            alert('Error fetching sorted data: ' + error.message);
            return null;
        }
    }

    function updateAdminTableBody(tableId, data, isMobile) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const tbody = table.tBodies[0];
        tbody.innerHTML = '';

        data.forEach(row => {
            const tr = document.createElement('tr');
            if (isMobile) {
                tr.innerHTML = `
                    <td>${row.index}</td>
                    <td>${row.nama_karyawan || 'N/A'}</td>
                    <td>${row.tanggal_absensi || 'N/A'}</td>
                    <td>${row.jam_masuk || 'N/A'}</td>
                    <td>${row.jam_keluar || 'N/A'}</td>
                    <td>${row.status_absensi || 'N/A'}</td>
                    <td>${row.koordinat || 'N/A'}</td>
                    <td>${row.foto_masuk || 'Tidak ada'}</td>
                    <td>${row.foto_keluar || 'Tidak ada'}</td>
                `;
            } else {
                tr.innerHTML = `
                    <td>${row.index}</td>
                    <td>${row.nama_karyawan || 'N/A'}</td>
                    <td>${row.tanggal_absensi || 'N/A'}</td>
                    <td>${row.jam_masuk || 'N/A'}</td>
                    <td>${row.jam_keluar || 'N/A'}</td>
                    <td>${row.status_absensi || 'N/A'}</td>
                    <td>${row.koordinat || 'N/A'}</td>
                    <td>${row.foto_masuk || 'Tidak ada'}</td>
                    <td>${row.foto_keluar || 'Tidak ada'}</td>
                `;
            }
            tbody.appendChild(tr);
        });
    }

    function attachAdminAjaxSorting(tableId, isMobile) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const headers = table.querySelectorAll('th[data-sortable]');

        headers.forEach((th) => {
            th.style.cursor = 'pointer';
            let sortOrder = 'asc';

            th.addEventListener('click', async () => {
                // Get sortBy from data-sortable attribute, not from text content
                const sortBy = th.getAttribute('data-sortable');

                if (!sortBy) {
                    console.warn('Sort column not found for header:', th.textContent);
                    return;
                }

                console.log('Header clicked, sortBy:', sortBy, 'sortOrder:', sortOrder);

                // Update sort indicators
                headers.forEach(h => {
                    const s = h.querySelector('.sort-indicator');
                    if (s) s.textContent = '';
                });
                const indicator = th.querySelector('.sort-indicator');
                if (indicator) indicator.textContent = sortOrder === 'asc' ? ' ▲' : ' ▼';

                // Fetch sorted data
                const data = await fetchSortedAdminData(sortBy, sortOrder, isMobile ? 'mobile' : 'desktop');
                if (data) {
                    console.log('Updating table with', data.length, 'rows');
                    updateAdminTableBody(tableId, data, isMobile);
                }

                // Toggle sort order for next click
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            });
        });
    }

    // Attach AJAX sorting for both tables when DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOMContentLoaded: Attaching AJAX sorting');
        attachAdminAjaxSorting('absensiMobileTable', true);
        attachAdminAjaxSorting('absensiDesktopTable', false);
        // Toggle filter inputs (month/week) based on selected filter_type
        const filterTypeEl = document.getElementById('filter_type');
        const monthWrapper = document.getElementById('month_input_wrapper');
        const weekWrapper = document.getElementById('week_input_wrapper');
        if (filterTypeEl) {
            // ensure correct disabled state on load
            const monthInput = document.getElementById('filter_value_month');
            const weekInput = document.getElementById('filter_value_week');
            if (monthInput && weekInput) {
                // If filter type is month, enable month input and disable week input, else vice versa
                const initVal = filterTypeEl.value;
                monthInput.disabled = initVal !== 'month';
                weekInput.disabled = initVal !== 'week';
            }

            filterTypeEl.addEventListener('change', function() {
                const v = this.value;
                if (v === 'month') {
                    monthWrapper.style.display = 'block';
                    weekWrapper.style.display = 'none';
                    if (monthInput) { monthInput.disabled = false; monthInput.setAttribute('name','filter_value'); }
                    if (weekInput) { weekInput.disabled = true; weekInput.removeAttribute('name'); }
                } else if (v === 'week') {
                    monthWrapper.style.display = 'none';
                    weekWrapper.style.display = 'block';
                    if (monthInput) { monthInput.disabled = true; monthInput.removeAttribute('name'); }
                    if (weekInput) { weekInput.disabled = false; weekInput.setAttribute('name','filter_value'); }
                } else {
                    monthWrapper.style.display = 'none';
                    weekWrapper.style.display = 'none';
                    if (monthInput) { monthInput.disabled = true; monthInput.removeAttribute('name'); }
                    if (weekInput) { weekInput.disabled = true; weekInput.removeAttribute('name'); }
                }
            });
        }
    });
</script>
</html>