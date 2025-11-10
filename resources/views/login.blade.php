<html data-bs-theme="light" lang="en">
    <!-- Latest compiled and minified CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- Fav Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INGOO || Login</title>
</head>

<style>
    .bg-login-image{
        background-image: url('https://images.unsplash.com/photo-1527689368864-3a821dbccc34?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
        background-position: center;
        background-size: cover;
    }
</style>

<body>
    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="width: 100%;height: 100%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-flex">
                                    <div class="flex-grow-1 bg-login-image">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h4 class="text-dark mb-4">Hi there. Welcome!</h4>
                                            </div>
                                            <div class="overflow-auto">
                                                @if (Session::has('message'))
                                                <div class="alert alert-warning" role="alert"><center>{{ Session::get('message') }}</center></div>
                                                @endif
                                            </div>
                                            <form class="user" method="POST" action="{{ route('prosesAuthentifikasi') }}">
                                                @csrf
                                                <!-- login dengan username/email-->
                                                <div class="mb-3">
                                                    <i class="fa fa-user" aria-hidden="true"></i> | Your Username or Email<input id="exampleInputEmail" class="form-control form-control-user" type="text" aria-describedby="emailHelp" placeholder="Enter your username or email" name="name_or_email" required/>
                                                </div>
                                                <div class="mb-3">
                                                    <i class="fa fa-key" aria-hidden="true"></i> | Your Password <input id="exampleInputPassword" class="form-control form-control-user" type="password" placeholder="Password" name="password" required/>
                                                </div>
                                                <div class="mb-3">
                                                    <!-- Role -->
                                                    <i class="fa fa-user-o" aria-hidden="true"></i> | Pilih Role
                                                    <select class="form-control" name="role" required>
                                                        <option value="karyawan">Karyawan</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-outline-dark d-block btn-user w-100" type="submit">Login <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                <hr />
                                                <a href="#" class="btn btn-outline-dark d-block btn-user w-100" >or Sign in with Google <i class="fa fa-google" aria-hidden="true"></i></a>
                                                <hr />
                                            </form>
                                            <div class="text-center"><a class="small" href="forgot-password.html" >Forgot Password?</a></div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>