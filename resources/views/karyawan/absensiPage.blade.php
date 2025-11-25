<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <!-- Add logo page-->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_ingoo_page.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Absensi ({{ session('user_name') }})</title>
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
    .if-table-displays-in-mobile {
            display: none;
    }
    .if-table-displays-in-desktop {
            display: inline;
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
    /* Menu button styling - icon above, text below */
    .menu-btn {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
        min-height: 60px;
        padding: 0.5rem !important;
    }
    .menu-btn i {
        font-size: 18px;
    }
    .menu-btn span {
        display: block;
        font-size: 12px;
    }
    /* 2-column grid layout for menu */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        max-width: 400px;
        margin: 0 auto;
        padding: 1.5em;
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
        h6 {
            font-size: 12px !important;
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
            overflow-x: auto;
            display: inline;
        }
        .logo-layout{
            padding-left: 80px;
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
            <!-- Desktop Mode -->
            <div class="container-fluid">
                <div class="d-flex align-items-center">

                    <!--logo Perusahaan -->
                    <div class="">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <div class="flex-fill"></div>

                    <!-- Menu button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse gap-2 p-2">
                        <a class="btn btn-outline-dark" href="{{ route('karyawan/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
                                <a class="dropdown-item" href="{{ route('karyawan/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
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

                    <!-- Menu button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse gap-2 p-2">
                        
                        <a class="btn btn-outline-dark" href="{{ route('karyawan/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
                                <a class="dropdown-item" href="{{ route('karyawan/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="text-center">
                <h2 class="mt-2">Absensi</h2>
                <div
                    class="alert alert-info text-center mt-4"
                    role="alert"
                >
                    <span style="font-weight: bold;">Informasi Absensi:</span><br>
                    <span>Tanggal : {{ $tanggal }} ;</span>
                    <span>Jam Kerja: {{ $jam_masuk_kerja }} - {{ $jam_keluar_kerja }} ;</span>
                    <span>Sekarang: {{ $sekarang }}</span>
                </div>
                
            </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                    {{ session('error') }}
                    </div>
                @endif
                @if($jam_masuk_kerja <= $sekarang && $sekarang <= $jam_keluar_kerja)
                    @if($sudah_absen_masuk && $sudah_absen_keluar)
                        <div class="alert alert-success text-center mt-4" role="alert">
                            <span>Anda sudah melakukan absensi masuk dan keluar hari ini.</span>
                        </div>
                    @elseif($sudah_absen_masuk && !$sudah_absen_keluar)
                        <div class="alert alert-success text-center mt-4" role="alert">
                            <span>Anda sudah melakukan absensi masuk hari ini.</span>
                        </div>
                        <div class="menu-grid">
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi_kamera/check_in') }}'" disabled>
                                <i class="fas fa-camera" aria-hidden="true"></i>
                                <span class="text-center">Absensi Masuk</span>
                            </button>
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi_kamera/check_out') }}'">
                                <i class="fas fa-camera" aria-hidden="true"></i>
                                <span class="text-center">Absensi Keluar</span>
                            </button>
                            <!-- Disable izin and sakit buttons after check-in -->
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi/izin') }}'"disabled>
                                <i class="fas fa-file-medical" aria-hidden="true"></i>
                                <span class="text-center">Absensi Izin</span>
                            </button>
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi/sakit') }}'"disabled>
                                <i class="fas fa-notes-medical" aria-hidden="true"></i>
                                <span class="text-center">Absensi Sakit</span>
                            </button>
                        </div>
                    @else
                        <div class="alert alert-info text-center mt-4" role="alert">
                            <span>Jika berhalangan sakit atau apapun, silakan pilih Absensi Izin atau Absensi Sakit</span>
                        </div>
                        <div class="menu-grid">
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi_kamera/check_in') }}'">
                                <i class="fas fa-camera" aria-hidden="true"></i>
                                <span class="text-center">Absensi Masuk</span>
                            </button>
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi_kamera/check_out') }}'" disabled>
                                <i class="fas fa-camera" aria-hidden="true"></i>
                                <span class="text-center">Absensi Keluar</span>
                            </button>
                            <!-- Disable izin and sakit buttons after check-in -->
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi/izin') }}'">
                                <i class="fas fa-file-medical" aria-hidden="true"></i>
                                <span class="text-center">Absensi Izin</span>
                            </button>
                            <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi/sakit') }}'">
                                <i class="fas fa-notes-medical" aria-hidden="true"></i>
                                <span class="text-center">Absensi Sakit</span>
                            </button>
                        </div>
                    @endif
                @else
                <div class="alert alert-warning text-center mt-4" role="alert">
                    <p>Jam Kerja sudah habis. Anda tidak dapat melakukan absensi hari ini.</p>
                </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>