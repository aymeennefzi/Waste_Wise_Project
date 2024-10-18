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
			<!-- Inclure le header -->
			@include('Shared.header')
			<!-- Inclure le sideBar -->
			@include('Shared.sideBar')
			<div class="clearfix"></div>
			<div class="content-wrapper ">
				<div class="container-fluid ">
					<!--Start Dashboard Content-->
					<div class="card mt-3 ">
					<div class="card-body ">

						  <!-- -------- ici -------- -->
						  @yield('content') <!-- Cette ligne permet d'inclure le contenu spécifique -->
                    <!-- --------------------- -->
					</div>
					</div>
					<!--End Dashboard Content-->
				</div>
				<!--End content-wrapper-->
				<!--Start Back To Top Button-->
				<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
				<!--End Back To Top Button-->
				@include('Shared.footer') 
				<!-- Inclure le footer -->
			</div>
			<!--End wrapper-->
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
