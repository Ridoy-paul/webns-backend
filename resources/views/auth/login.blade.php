<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('login_resources/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/css/main.css') }}">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100" style="padding-top: 110px !important;">
                <div class="login100-pic js-tilt" data-tilt=""
                    style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                    <img src="{{ asset('login_resources/images/yemico-logo.png') }}" alt="IMG">
                </div>
                <form class="login100-form validate-form" method="POST" action="{{ route('login.confirm') }}">
                    @csrf
                    <span class="login100-form-title">
                        Welcome Back!
                    </span>
                    @error('email')
                        <span class="error text-danger my-2">{{ $message }}</span>
                    @enderror
                   
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="error text-danger my-2">{{ $message }}</span>
                    @enderror

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="code" placeholder="Enter Code" value="{{ old('code') }}" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="">
                            Password?
                        </a>
                    </div>
                    <div class="text-center p-t-50">
                        <span class="txt1">Have no account?</span>
                        <a class="txt2 text-info" href="{{ route('register') }}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('login_resources/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('login_resources/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('login_resources/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login_resources/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('login_resources/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })

    </script>
    <script src="js/main.js"></script>
</body>
</html>
