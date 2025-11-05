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
    <title>Registration Form</title>
</head>
<style>
    
    
</style>
<body>
    <div class="container" style="position: absolute;left: 0;right: 0;top: 50%;transform: translateY(-50%);-ms-transform: translateY(-50%);-moz-transform: translateY(-50%);-webkit-transform: translateY(-50%);-o-transform: translateY(-50%);">
        <div class="row d-flex d-xl-flex justify-content-center justify-content-xl-center">
            <div class="col-sm-12 col-lg-10 col-xl-9 col-xxl-7 bg-white shadow-lg" style="border-radius: 5px;">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-4">Create an Account!</h4>
                    </div>
                    @if (Session::has('message'))
                    <div class="alert alert-warning" role="alert"><center>{{ Session::get('message') }}</center></div>
                    @endif
                    <form class="user" method="post" action="{{ route('prosesRegister') }}">
                        @csrf
                        <div class="mb-3"><i class="fa fa-user" aria-hidden="true"></i> | Your Username <input class="form-control form-control-user" type="text" placeholder="Username" name="name" /></div>
                        <div class="mb-3"><i class="fas fa-mail-bulk"></i> | Your Email<input id="email" class="form-control form-control-user" type="email" placeholder="Email Address" required name="email"/></div>
                        <i class="fa fa-key" aria-hidden="true"></i> | Your Password
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0"><input id="password" class="form-control form-control-user" type="password" placeholder="Password" name="password" required /></div>
                            <div class="col-sm-6"><input id="verifyPassword" class="form-control form-control-user" type="password" placeholder="Repeat Password" required /></div>
                        </div>
                        <div class="row mb-3">
                            <p id="emailErrorMsg" class="text-danger" style="display: none;">Paragraph</p>
                            <p id="passwordErrorMsg" class="text-danger" style="display: none;">Paragraph</p>
                        </div class="row mb-3"><button id="submitBtn" class="btn btn-outline-dark d-block btn-user w-100" type="submit">Register Account <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
                        <hr />
                        <a href="#" class="btn btn-outline-dark d-block btn-user w-100" hidden>or Sign up Account with Google <i class="fa fa-google" aria-hidden="true"></i></a>
                        <hr />
                    </form>
                    <div class="mb-3"></div>
                    <div class="text-center"><a class="small" href="forgot-password.html">Forgot Password?</a></div>
                    <div class="mb-3"></div>
                    <div class="text-center"><a class="small" href="{{ route('login') }}">Already have an account? Login!</a></div>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</body>

</html>