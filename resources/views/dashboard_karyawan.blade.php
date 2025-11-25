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
    <title>INGOO || Home ({{ session('user_name') }})</title>
</head>

<style>
    html, body {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    nav {
        background-color: #ffffff;
    }
    main{
        padding: 2px;
        flex: 1;
    } 
    footer {
        background-color: #ffffff;
        width: 100%;
        height: 40px;
        margin-top: auto;
    }
    /* Footer responsive variants */
    .desktop-footer {
        display: inline;
    }
    .mobile-footer {
        display: none;
    }
    .version-footer {
        display: inline;
    }
    .hide-on-small {
        display: inline;
    }
    .if-table-displays-in-mobile {
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
    .desktop-mode{
        display: inline;
    }
    .mobile-mode{
        display: none;
    }
    @media (max-width: 500px) {
        /* font size from all body gets smaller, except menu buttons */
        body,nav,main,footer,h1,h2,h3,h4,h5,h6,p,a,div {
            font-size: 100% !important;
        }
        span {
            font-size: 12px !important;
        }
        /* Keep menu button text size unchanged */
        .menu-btn{
            font-size: 12px !important;
        }
        .btn {
            padding: 0.2rem 0.5rem !important;
            font-size: 14px !important;
        }
        .hide-on-small {
            display: none;
        }
        .if-table-displays-in-desktop {
            display: none;
        }
        /* On small screens hide the long desktop copyright and version
           and show a compact mobile footer line */
        .desktop-footer {
            display: none !important;
        }
        .mobile-footer {
            display: inline !important;
        }
        .version-footer {
            display: none !important;
        }
        /* ensure footer works properly on small screens */
        footer {
            height: auto;
        }
        .desktop-mode{
            display: none;
        }
        .mobile-mode{
            display: inline;
        }
        .logo-layout{
            padding-left: 25px;
        }
    }
</style>
<body>
    <nav>
        <div class="desktop-mode">
            <div class="container-fluid">
                <div class="d-flex align-items-center">

                    <!--logo Perusahaan -->
                    <div class="logo-layout">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <div class="flex-fill"></div>

                    <!-- Logout button on the right -->
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-outline-dark" href="{{ route('karyawan/logout') }}" role="button"><span class="hide-on-small">Log out </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-mode">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="flex-fill"></div>

                    <!--logo Perusahaan -->
                    <div class="text-center logo-layout">
                        <img src="{{ asset('logo/logo_ingoo.png') }}" alt="INGOO" style="weight:auto; height:70px;" class="img-fluid mx-auto">
                    </div>

                    <!-- Logout button on the right -->
                    <div class="flex-fill d-flex justify-content-end">
                        <a class="btn btn-outline-dark" href="{{ route('karyawan/logout') }}" role="button"><span class="hide-on-small">Log out </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container text-center">
            <h1 class="mt-5">Welcome, {{ Auth::user()->name }}</h1>
            <p>You have successfully logged in.</p>
        </div>
        <div class="container">
            <div class="text-center"><h2 class="mt-5">Main Menu</h2></div>
                <div class="menu-grid">
                    <a class="btn btn-outline-dark menu-btn" href="{{ route('karyawan.profile', Auth::user()->id) }}" role="button">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="text-center">Profile</span>
                    </a>
                    <button class="btn btn-outline-dark menu-btn" onclick="location.href='{{ route('karyawan/absensi') }}'">
                        <i class="fas fa-pencil" aria-hidden="true"></i>
                        <span class="text-center">Absensi</span>
                    </button>
                    <a class="btn btn-outline-dark menu-btn" href="{{ route('karyawan/histori_absensi') }}" role="button">
                        <i class="fa fa-table" aria-hidden="true"></i>
                        <span class="text-center">Histori Absensi</span>
                    </a>
                    <a class="btn btn-outline-dark menu-btn" href="#" role="button">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span class="text-center">Pengaturan</span>
                    </a>

                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-fluid">
            <div class="d-flex justify-content-around p-2">
                <!-- Desktop: full copyright with -->
                <span class="text-center desktop-footer">&copy; 2025 Rian Hadi & PT.Internet Network Global Online. All rights reserved</span>
                <!-- Mobile: compact single-line copyright + version with smaller font size (shown at <=500px) -->
                <span class="text-center mobile-footer">&copy; 2025 Rian Hadi & INGOO | v 1.0.0 Beta 1</span>
                <span class="text-center version-footer">Version 1.0.0 Beta 1</span>
            </div>
        </div>
    </footer>
</body>
</html>