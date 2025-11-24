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
    /*untuk layout mode desktop*/
    .bg-login-image{
        background-image: url('https://images.unsplash.com/photo-1527689368864-3a821dbccc34?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
        background-position: center;
        background-size: cover;
    }
    .logo {
        width: 30%;
        height: auto;
    }
    /*untuk layout mode mobile font and logo harus fit*/
    @media (max-width: 576px) {
        .logo {
            width: 65%;
            height: auto;
            padding-right: 15px;
        }
        span{
            font-size: 14px;
        }
        /* make input placeholders match mobile layout font-size */
        .form-control::placeholder,
        input::placeholder {
            font-size: 14px;
            opacity: 1; /* ensure visibility on some browsers */
        }
        /* make select and option text match mobile layout font-size */
        .form-select,
        .form-select option,
        select.form-select,
        select.form-select option {
            font-size: 14px;
        }
        /* Smaller input sizing for compact forms */
        .small-input {
            font-size: 0.85rem;
            line-height: 1.25;
        }
        .small-input::placeholder {
            font-size: 0.85rem;
            opacity: 1;
        }
        .message-text-mobile {
            font-size: 0.9rem;
        }
    }
</style>

<body>
    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="width: 100%;height: 100%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                                        <div class="p-4">
                                            <!-- logo perusahaan di folder public/logo -->
                                            <div class="text-center">
                                                <img class="logo" src="{{ asset('logo/logo_ingoo.png') }}" alt="Company Logo">
                                            </div>  
                                            <div class="overflow-auto">
                                                @if(session('error'))
                                                    <div class="message-text-mobile alert alert-danger mt-3">{{ session('error') }}</div>
                                                @endif
                                                @if(session('message'))
                                                    <div class="message-text-mobile alert alert-info mt-3">{{ session('message') }}</div>
                                                @endif
                                            </div>
                                            <form class="user" method="POST" action="{{ route('prosesAuthentifikasi') }}">
                                                @csrf
                                                <!-- login dengan username/email-->
                                                <div class="mb-3">
                                                    <i class="fa fa-user" aria-hidden="true"></i><span>| Username anda/ Email anda</span>
                                                    <input id="InputEmailorUsername" class="form-control form-control-user small-input" type="text" aria-describedby="emailHelp" placeholder="Masukkan username atau email anda" name="name_or_email" required/>
                                                </div>
                                                <div class="mb-3">
                                                    <i class="fa fa-key" aria-hidden="true"></i><span>| Password anda</span>
                                                    <div class="position-relative">
                                                        <input id="InputPassword" class="form-control form-control-user small-input" type="password" placeholder="Masukkan password anda" name="password" required/>
                                                        <i class="fa fa-eye position-absolute" id="togglePassword" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <!-- Role -->
                                                    <i class="fa fa-user-o" aria-hidden="true"></i><span>| Pilih Role</span>
                                                    <select class="form-select form-select-md small-input" name="role" required>
                                                        <option value="karyawan">Karyawan</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-outline-dark d-block btn-user w-100" type="submit">Login <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
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
</body>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('InputPassword');
        const toggleIcon = this;
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
</script>
</html>