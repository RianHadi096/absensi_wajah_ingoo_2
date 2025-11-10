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
    <title>INGOO || Home ({{ session('role') }})</title>
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
    @media (max-width: 500px) {
        .hide-on-small {
            display: none;
        }
        .if-table-displays-in-desktop {
            display: none;
        }
    }
</style>
<body>
    <nav>
        <div class="container-fluid bg-light">
            <div class="d-flex flex-row-reverse p-2">
                <a class="btn btn-outline-dark" href="{{ route('admin/logout') }}" role="button"><span class="hide-on-small">Log out </span><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>
    <main>
        <div class="container text-center">
            <h1 class="mt-5">Welcome</h1>
            <p class="lead">
                @php
                    //get session from role
                    $role = session('role');
                    echo "You successfuly logged in as $role.";
                @endphp
            </p>
        </div>
        <div class="container">
            <div class="text-center"><h2 class="mt-5">Main Menu</h2></div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn btn-outline-dark m-2" href="{{ route('admin.karyawan') }}" role="button"><i class="fa fa-user" aria-hidden="true"></i> Kelola Karyawan</a>
                    <a class="btn btn-outline-dark m-2" href="{{ route('histori_absensi_karyawan') }}" role="button"><i class="fa fa-user" aria-hidden="true"></i><i class="fa fa-book" aria-hidden="true"></i> Kelola Histori Absensi Karyawan</a>
                    <a class="btn btn-outline-dark m-2" href="#" role="button"><i class="fa fa-cog" aria-hidden="true"></i> Pengaturan</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="endpage">
        <div class="d-flex justify-content-center align-items-center h-100">
            <span class="text-muted">© 2025 Rian Hadi</span>
        </div>
    </footer>
</body>
</html>