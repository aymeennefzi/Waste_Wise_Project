<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <!-- loader-->
  <link href="{{ asset('Back_office/assets/css/pace.min.css')}}" rel="stylesheet"/>
  <script src="{{ asset('Back_office/assets/js/pace.min.js')}}"></script>
  <!--favicon-->
  <link rel="icon" href="{{ asset('Back_office/assets/images/favicon.ico')}}" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="{{ asset('Back_office/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{ asset('Back_office/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('Back_office/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <link href="./" rel="stylesheet"/>
  <link rel="stylesheet"type="text/css"  href="{{ asset('Back_office/assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- animate CSS-->
  <link href="{{ asset('Back_office/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('Back_office/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('Back_office/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('Back_office/assets/css/app-style.css')}}" rel="stylesheet"/>
</head>

<body class="bg-theme bg-theme1">
 
<!-- Start wrapper-->
<div id="wrapper">
<div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
<div  id="wrapper">
    <div class="card card-authentication1 mx-auto my-5">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="text-center">
                    <img src="{{ asset('Back_office/assets/images/loder.png')}}" alt="logo icon" width="150" height="auto">
                </div>
            <div class="card-title text-uppercase text-center py-3">Sign In</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                <label for="email" class="sr-only">{{ __('Email') }}</label>
                <div class="position-relative has-icon-right">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control input-shadow" placeholder="Enter email">
                    <div class="form-control-position">
                        <i class="icon-user"></i>
                    </div>
                    @if($errors->has('email'))
                    <span class="error">{{ $errors->first('email') }}</span>
                @endif
                </div>
                </div>
                <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <div class="position-relative has-icon-right">
                    <input id="password" type="password" name="password" required class="form-control input-shadow" placeholder="Enter Password">
                    <div class="form-control-position">
                        <i class="icon-lock"></i>
                    </div>
                    @if($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                </div>
            <div class="form-row">
                <div class="form-group col-6">
                <div class="icheck-material-white">
                    <label for="user-checkbox">
                        <input type="checkbox" id="user-checkbox" name="remember">
                            {{ __('Remember me') }}                
                    </label>
                </div>
                </div>
                <div class="form-group col-6 text-right">
                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                </div>
            </div>
                <button type="submit" class="btn btn-light btn-block">{{ __('Log in') }}</button>
                <div class="text-center mt-3">Sign In With</div>
                
                <div class="form-row mt-4">
                <div class="form-group mb-0 col-6">
                <a type="button" href="{{ url('auth/facebook') }}" class="btn btn-light btn-block">
                    <i class="fa fa-facebook-square"></i> Facebook
                </a>
                </div>
                <div class="form-group mb-0 col-6 text-right">
                <a type="button" href="{{ url('auth/google') }}" class="btn btn-light btn-block">
                    <i class="fa fa-google"></i> Google
                </a>
                </div>
            </div>
                
                </form>
            </div>
            </div>
            <div class="card-footer text-center py-3">
            <p class="text-warning mb-0">Do not have an account? <a href="{{ route('register') }}"> Sign Up here</a></p>
            </div>
            </div>
    
        <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    </div><!--wrapper-->


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('Back_office/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('Back_office/assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('Back_office/assets/js/bootstrap.min.js')}}"></script>
    <!-- simplebar js -->
    <script src="{{ asset('Back_office/assets/plugins/simplebar/js/simplebar.js')}}"></script>
    <!-- sidebar-menu js -->
    <script src="{{ asset('Back_office/assets/js/sidebar-menu.js')}}"></script>
    <!-- loader scripts -->
    <script src="{{ asset('Back_office/assets/js/jquery.loading-indicator.js')}}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('Back_office/assets/js/app-script.js')}}"></script>
    <!-- Chart js -->
    <script src="{{ asset('Back_office/assets/plugins/Chart.js/Chart.min.js')}}"></script>
    <!-- Index js -->
    <script src="{{ asset('Back_office/assets/js/index.js')}}"></script>
    </body>
    </html>