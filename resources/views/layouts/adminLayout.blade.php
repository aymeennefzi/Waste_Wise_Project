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
		<!-- Add this in your <head> section for Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

		<!-- Add this before the closing </body> tag for Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

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
			<!-- start loader -->
			<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

	@include('Shared.sideBar')
	@include('Shared.header')



<div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">
	@yield('content')
    </div>

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->



  </div><!--End wrapper-->

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

            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([36.8065, 10.1815], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([36.8065, 10.1815], { draggable: true }).addTo(map);

        marker.on('dragend', function () {
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('location').value = https://www.google.com/maps?q=${lat},${lng};
        });
    });
</script>
		</body>
	</html>
