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
    @media (max-width: 500px) {
        .hide-on-small {
            display: none;
        }
        .if-table-displays-in-desktop {
            display: none;
        }
        .if-table-displays-in-mobile {
            display: inline;
        }
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
</style>

<body>
    <nav>
        <div class="container-fluid bg-light">
            <div class="d-flex flex-row-reverse p-2">
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
                        <div class="table-responsive">
                            <div class="if-table-displays-in-mobile">
                                <!-- Table Absensi Karyawan Mode Vertical -->
                                 @foreach ($fetch_data_absensi_karyawan_mobile as $absensi_mobile)
                                <table class="table table-bordered mt-4">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>{{ $absensi_mobile->nama_karyawan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Absensi</th>
                                        <td>{{ $absensi_mobile->tanggal_absensi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Absensi</th>
                                        <td>{{ $absensi_mobile->waktu_absensi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Absensi</th>
                                        <td>{{ $absensi_mobile->status_absensi ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Koordinat (Google Maps)</th>
                                        <td>{{ $absensi_mobile->koodinat ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                                @endforeach
                            </div>
                            <div class="if-table-displays-in-desktop">
                                <table class="table table-bordered table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Tanggal Absensi</th>
                                            <th>Waktu Absensi</th>
                                            <th>Status Absensi</th>
                                            <th>Koordinat (Google Maps)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fetch_data_absensi_karyawan_desktop as $index => $absensi_desktop)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absensi_desktop->nama_karyawan }}</td>
                                            <td>{{ $absensi_desktop->tanggal_absensi }}</td>
                                            <td>{{ $absensi_desktop->waktu_absensi }}</td>
                                            <td>{{ $absensi_desktop->status_absensi ?? 'N/A' }}</td>
                                            <td>{{ $absensi_desktop->koodinat ?? 'N/A'}}</td>
                                        </tr>
                                        @endforeach
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

</body>
</html>