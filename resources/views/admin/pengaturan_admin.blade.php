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
    <title>INGOO || Pengaturan ({{ session('role') }})</title>
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
                        <a class="btn btn-outline-dark" href="{{ route('admin/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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

                    <!-- Menu button on the right -->
                    <div class="flex-fill d-flex flex-row-reverse gap-2 p-2">
                        
                        <a class="btn btn-outline-dark" href="{{ route('admin/logout') }}" role="button"><i class="fas fa-sign-out-alt"></i><span class="hide-on-small"> Logout</span></a>
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
                                <a class="dropdown-item" href="{{ route('admin/dashboard') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Main Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="text-center"><h2 class="mt-5">Pengaturan Jam Kerja</h2></div>
            @if (session('message'))
                <div class="alert alert-info alert-dismissible fade show mt-3">
                    {{ session('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <form action="{{ route('admin.pengaturan.jamkerja.update') }}" method="POST">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Pilih Jabatan</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <select class="form-select" id="jabatan" name="jabatan">
                                        <option value="marketing">Marketing</option>
                                        <option value="teknisi">Teknisi</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jam_kerja" class="form-label">Jam Kerja</label>
                                        <input type="time" class="form-control" id="jam_kerja" name="jam_kerja" value="" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jam_selesai_kerja" class="form-label">Batas Jam Kerja</label>
                                        <input type="time" class="form-control" id="batas_jam_kerja" name="batas_jam_kerja" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark"><i class="fa fa-save"></i> Simpan Pengaturan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
</html>