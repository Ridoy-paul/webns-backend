<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('login_resources/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('login_resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('login_resources/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_resources/css/main.css') }}">
    <style>
        p {
            text-align: justify !important;
            margin-bottom: 20px !important;
        }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100" style="padding-top: 70px !important;">
                <div class="login100-pic js-tilt" data-tilt style="margin-top: 7%;">
                    <img src="{{ asset('login_resources/images/yemico-logo.png') }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('registration.confirm') }}">
                    @csrf
                    <span class="login100-form-title" style="padding-bottom: 20px !important;">
                        Registration
                    </span>
                
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                
                    {{-- <div class="wrap-input100 validate-input">
                        <input class="input100" type="number" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </span>
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div> --}}
                
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="code" placeholder="Enter Code" value="{{ old('code') }}" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                
                
                    <div class="container-login100-form-btn" style="padding-top: 0px !important;">
                        <button class="login100-form-btn">
                            Submit
                        </button>
                    </div>
                
                    <div class="text-center p-t-12">
                        <span class="txt1">Have an account?</span>
                        <a class="txt2 text-info" href="{{ route('login') }}">Login</a>
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
