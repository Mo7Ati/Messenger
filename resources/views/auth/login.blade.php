<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log in | Chatvia - Responsive Bootstrap 5 Chat App</title>
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
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="30"
                                class="logo logo-dark">
                            <img src="assets/images/logo-light.png" alt="" height="30"
                                class="logo logo-light">
                        </a>

                        <h4>Sign in</h4>
                        <p class="text-muted mb-4">Sign in to continue to Chatvia.</p>

                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-3">
                                <form action="login" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="input-group mb-3 bg-light-subtle rounded-3">
                                            <span class="input-group-text text-muted" id="basic-addon3">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                            <input type="text" name="email"
                                                class="form-control
                                                @error('password')
                                                    is-invalid
                                                @enderror
                                                form-control-lg border-light bg-light-subtle"
                                                placeholder="Enter Username" aria-label="Enter Username"
                                                aria-describedby="basic-addon3">
                                        </div>
                                        @error('email')
                                            <div class=" invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-3 bg-light-subtle rounded-3">
                                            <span class="input-group-text text-muted" id="basic-addon4">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                            <input name="password" type="password"
                                                class="form-control
                                                @error('password')
                                                    is-invalid
                                                @enderror
                                                form-control-lg
                                                 border-light bg-light-subtle"
                                                placeholder="Enter Password" aria-label="Enter Password"
                                                aria-describedby="basic-addon4">
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="remember-check">
                                        <label class="form-check-label" for="remember-check">Remember me</label>
                                    </div>

                                    <div class="d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Sign
                                            in</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>Don't have an account ?
                            @if (Route::has('register'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    href="{{ route('register') }}">
                                    {{ __('Sign Up Now') }}
                                </a>
                            @endif
                        </p>
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
