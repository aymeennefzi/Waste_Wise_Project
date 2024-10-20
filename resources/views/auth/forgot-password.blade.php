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
			<div class="height-100v d-flex align-items-center justify-content-center">
				<div class="card card-authentication1 mb-0">
					<div class="card-body">
						<div class="card-content p-2">
							<div class="card-title text-uppercase pb-2">
								Reset Password
							</div>
							<p class="pb-2">
								Please enter your email address. You will receive a link to create a new password via email.
							</p>

							<!-- Affichage du statut -->
							<x-auth-session-status class="mb-4 mt-2" :status="session('status')" />

							<!-- Formulaire -->
							<form class="mt-sm-4 text-start" method="POST" action="{{ route('password.email') }}">
								@csrf
								<div class="form-group">
									<label for="email" class="form-label">Email Address</label>
									<div class="position-relative has-icon-right">
										<input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="form-control input-shadow" placeholder="Email Address">
										<div class="form-control-position">
											<i class="icon-envelope-open"></i>
										</div>
									</div>
									<x-input-error :messages="$errors->get('email')" class="mt-2" />
								</div>
								<div class="mb-3 text-center">
                                    <p>Back to <a href="{{ route('login') }}">Sign in</a></p>
                                </div>
								
								<button type="submit" class="btn btn-light btn-block mt-3">{{ __('Email Password Reset Link') }}</button>
							</form>
							<!-- Fin du formulaire -->
						</div>
					</div>
				</div>
			</div>
			<!--Start Back To Top Button-->
			<a href="javascript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
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