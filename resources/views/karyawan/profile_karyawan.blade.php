<!DOCTYPE html>
<html lang="en">
        <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGOO || Home ({{ session('user_name') }})</title>
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
    <main>>
        <!-- konten profile karyawan-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-4">
                        <div class="card-header text-center">
                            <h3>Profile Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <!-- Card-based layout for profile fields -->
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Nama Lengkap:</label>
                                    <span>{{ $karyawan->nama_lengkap }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Registered as:</label>
                                    <span>{{ $username }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Email:</label>
                                    <span>{{ $email }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Tanggal Lahir:</label>
                                    <span>{{ $tanggal_lahir }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Bagian:</label>
                                    <span>{{ $karyawan->bagian }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Jabatan:</label>
                                    <span>{{ $karyawan->jabatan }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="profile-field mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <label class="fw-bold text-muted">Tanggal Masuk Kerja:</label>
                                    <span>{{ $tanggal_masuk_kerja }}</span>
                                </div>
                            </div>
                            <hr>
                            <!-- Foto Karyawan -->
                            <div class="profile-field mb-3">
                                <label class="fw-bold text-muted d-block mb-2">Foto Karyawan:</label>
                                <div>
                                    @if ($karyawan->imageFileLocation)
                                        <button id="toggleButton" class="btn btn-outline-dark btn-sm mb-2"><i class="fa fa-file-image-o" aria-hidden="true"></i> Hide/Show</button>
                                        <div class="d-flex justify-content-center">
                                            <img id="foto-karyawan" src="{{ asset('storage/'.$karyawan->imageFileLocation) }}" alt="Foto Karyawan" style="max-width: 150px; max-height: 150px; display:none; border-radius: 8px;">
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        // Toggle photo visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleButton');
            if (toggleButton) {
                toggleButton.addEventListener('click', function() {
                    const fotoKaryawan = document.getElementById('foto-karyawan');
                    if (fotoKaryawan.style.display === 'none') {
                        fotoKaryawan.style.display = 'block';
                        this.innerHTML = '<i class="fa fa-file-image-o" aria-hidden="true"></i> Hide';
                    } else {
                        fotoKaryawan.style.display = 'none';
                        this.innerHTML = '<i class="fa fa-file-image-o" aria-hidden="true"></i> Show';
                    }
                });
            }
        });
    </script>
</body>
</html>