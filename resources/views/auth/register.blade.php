<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register | Chatvia - Responsive Bootstrap 5 Chat App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive Bootstrap 5 Chat App" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


</head>

<body>


    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <a href="index.html" class="auth-logo mb-5 d-block">
                            <img src="assets/images/logo-dark.png" alt="" height="30" class="logo logo-dark">
                            <img src="assets/images/logo-light.png" alt="" height="30"
                                class="logo logo-light">
                        </a>

                        <h4>Sign up</h4>
                        <p class="text-muted mb-4">Get your Chatvia account now.</p>

                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-3">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @endif
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group bg-light-subtle rounded-3  mb-3">
                                            <span class="input-group-text text-muted" id="basic-addon5">
                                                <i class="ri-mail-line"></i>
                                            </span>
                                            <input name="email" type="email"
                                                class="form-control form-control-lg bg-light-subtle border-light"
                                                placeholder="Enter Email" aria-label="Enter Email"
                                                aria-describedby="basic-addon5">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon6">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                            <input name="name" type="text"
                                                class="form-control form-control-lg bg-light-subtle border-light"
                                                placeholder="Enter Username" aria-label="Enter Username"
                                                aria-describedby="basic-addon6">

                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon7">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                            <input name="password" type="password"
                                                class="form-control form-control-lg bg-light-subtle border-light"
                                                placeholder="Enter Password" aria-label="Enter Password"
                                                aria-describedby="basic-addon7">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Password Confirmation</label>
                                        <div class="input-group bg-light-subtle mb-3 rounded-3">
                                            <span class="input-group-text border-light text-muted" id="basic-addon7">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                            <input name="password_confirmation" type="password"
                                                class="form-control form-control-lg bg-light-subtle border-light"
                                                placeholder="Enter Password Confirmation" aria-label="Enter Password "
                                                aria-describedby="basic-addon7">
                                        </div>
                                    </div>


                                    <div class="d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Sign
                                            up</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">By registering you agree to the Chatvia <a
                                                href="#" class="text-primary">Terms of Use</a></p>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary">
                                Signin </a> </p>
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Chatvia. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->



    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>
