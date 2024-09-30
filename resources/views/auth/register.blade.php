<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
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
			<div class="card card-authentication1 mx-auto my-4">
				<div class="card-body">
					<div class="card-content p-2">
						<div class="text-center">
							<img src="{{ asset('Back_office/assets/images/loder.png')}}" alt="logo icon" width="150" height="auto">
						</div>
						<div class="card-title text-uppercase text-center py-3">
							Sign Up
						</div>
						<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="exampleInputName" class="sr-only">{{ __('Name') }}</label>
								<div class="position-relative has-icon-right">
									<input id="name" type="text" name="name" value="{{ old('name') }}"  class="form-control input-shadow" placeholder="Enter Your Name" required autofocus>
									<div class="form-control-position">
										<i class="icon-user"></i>
									</div>
									@if($errors->
									has('name'))
									<span class="error">
										{{ $errors->
										first('name') }}
									</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="sr-only">{{ __('Email') }}</label>
								<div class="position-relative has-icon-right">
									<input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control input-shadow" required placeholder="Enter Your Email ">
									<div class="form-control-position">
										<i class="icon-envelope-open"></i>
									</div>
									@if($errors->
									has('email'))
									<span class="error">
										{{ $errors->
										first('email') }}
									</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="sr-only">Password</label>
								<div class="position-relative has-icon-right">
									<input type="password" id="password" name="password" class="form-control input-shadow" required placeholder="Choose Password">
									<div class="form-control-position">
										<i class="icon-lock"></i>
									</div>
									@if($errors->
									has('password'))
									<span class="error">
										{{ $errors->
										first('password') }}
									</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="password_confirmation" class="sr-only">{{ __('Confirm Password') }}</label>
								<div class="position-relative has-icon-right">
									<input id="password_confirmation" type="password" name="password_confirmation" class="form-control input-shadow" required placeholder="Confirm password">
									<div class="form-control-position">
										<i class="icon-lock"></i>
									</div>
									@if($errors->
									has('password_confirmation'))
									<span class="error">
										{{ $errors->
										first('password_confirmation') }}
									</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox" checked="" />
									<label for="user-checkbox">I Agree With Terms & Conditions</label>
								</div>
							</div>
							<div class="form-group">
								<label for="profile_photo_path">Profile Image</label>
								<input type="file" name="profile_photo_path" class="form-control">
							</div>
							<a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
							<button type="submit" class="btn btn-light btn-block waves-effect waves-light">{{ __('Register') }}</button>
							<div class="text-center mt-3">
								Sign Up With
							</div>
							<div class="form-row mt-4">
								<div class="form-group mb-0 col-6">
									<button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
								</div>
								<div class="form-group mb-0 col-6 text-right">
									<button type="button" class="btn btn-light btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--Start Back To Top Button-->
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
			<!--End Back To Top Button-->
		</div>
		<!--wrapper-->
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