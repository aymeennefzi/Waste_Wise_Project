<!doctype html>
<html class="no-js" lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>WasteWise</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('LandingPage/assets/img/favicon.ico')}}">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Montserrat:wght@500&display=swap" rel="stylesheet">
		<!-- CSS here -->
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/slicknav.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/flaticon.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/gijgo.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/animate.min.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/magnific-popup.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/fontawesome-all.min.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/themify-icons.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/slick.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/nice-select.css')}}">
		<link rel="stylesheet" href="{{ asset('LandingPage/assets/css/style.css')}}">
	</head>
	<body>
		<!-- ? Preloader Start -->
		<div id="preloader-active">
			<div class="preloader d-flex align-items-center justify-content-center">
				<div class="preloader-inner position-relative">
					<div class="preloader-circle"></div>
					<div class="preloader-img pere-text">
						<img src="{{ asset('LandingPage/assets/img/logo/loder1.png')}}" alt="">
					</div>
				</div>
			</div>
		</div>
		<!-- Preloader Start -->
		<header>
			<!--? Header Start -->
			<div class="header-area">
				<div class="main-header header-sticky">
					<div class="container-fluid">
						<div class="row align-items-center">
							<!-- Logo -->
							<div class="col-xl-2 col-lg-2 col-md-1">
								<div class="logo d-flex align-items-center">
									<!-- Utilisation de d-flex pour aligner les éléments -->
									<a href="/"><img src="{{ asset('LandingPage/assets/img/logo/loder1.png') }}" class="logo-img" alt=""></a>
									<span class="ml-2 wastewise-text" >Waste Wise</span>
								</div>
							</div>
							<div class="col-xl-10 col-lg-10 col-md-10">
								<div class="menu-main d-flex align-items-center justify-content-end">
									<!-- Main-menu -->
									<div class="main-menu f-right d-none d-lg-block">
										<nav>
											<ul id="navigation">
												<li><a href="/">Home</a></li>
												<li><a href="about.html">About</a></li>
												<li><a href="{{ route('item-posts.index') }}">Posts</a></li>
												<li><a href="schedule.html">Schedule</a></li>
												<li>
													<a href="blog.html">Blog</a>
													<ul class="submenu">
														<li><a href="blog.html">Blog</a></li>
														<li><a href="blog_details.html">Blog Details</a></li>
														<li><a href="elements.html">Element</a></li>
													</ul>
												</li>
												<li><a href="contact.html">Contact</a></li>
											</ul>
										</nav>
									</div>
									<div class="header-right-btn f-right d-none d-lg-block ml-30">
										<a href="{{ route('login') }}" class="btn header-btn">Sign In</a>
									</div>
								</div>
							</div>
							<!-- Mobile Menu -->
							<div class="col-12">
								<div class="mobile_menu d-block d-lg-none"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Header End -->
		</header>

		<main>		
			@yield('content')
		</main>


		<footer class=" footer-bottom-area " style="margin-top: 8%;">
		
			<div class=" footer-bg ">
				<div class="container">
					<div class="footer-border">
						<div class="row d-flex justify-content-between align-items-center">
							<div class="col-xl-10 col-lg-8 ">
								<div class="footer-copy-right">
									<p>
										<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->  Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
								</div>
							</div>
							<div class="col-xl-2 col-lg-4">
								<div class="footer-social f-right">
									<a href="#"><i class="fab fa-twitter"></i></a>
									<a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer End-->
		</footer>
		<!-- Scroll Up -->
		<div id="back-top" >
			<a title="Go to Top" href="#"><i class="fas fa-level-up-alt"></i></a>
		</div>
		<!-- JS here -->
		<script src="{{ asset ('LandingPage/assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{ asset('LandingPage/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/popper.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/bootstrap.min.js')}}"></script>
		<!-- Jquery Mobile Menu -->
		<script src="{{ asset('LandingPage/assets/js/jquery.slicknav.min.js')}}"></script>
		<!-- Jquery Slick , Owl-Carousel Plugins -->
		<script src="{{ asset('LandingPage/assets/js/owl.carousel.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/slick.min.js')}}"></script>
		<!-- One Page, Animated-HeadLin -->
		<script src="{{ asset('LandingPage/assets/js/wow.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/animated.headline.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/jquery.magnific-popup.js')}}"></script>
		<!-- Date Picker -->
		<script src="{{ asset('LandingPage/assets/js/gijgo.min.js')}}"></script>
		<!-- Nice-select, sticky -->
		<script src="{{ asset('LandingPage/assets/js/jquery.nice-select.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/jquery.sticky.js')}}"></script>
		<!-- counter , waypoint -->
		<script src="{{ asset('LandingPage/assets/js/jquery.counterup.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/waypoints.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/jquery.countdown.min.js')}}"></script>
		<!-- contact js -->
		<script src="{{ asset('LandingPage/assets/js/contact.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/jquery.form.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/jquery.validate.min.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/mail-script.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/jquery.ajaxchimp.min.js')}}"></script>
		<!-- Jquery Plugins, main Jquery -->
		<script src="{{ asset('LandingPage/assets/js/plugins.js')}}"></script>
		<script src="{{ asset('LandingPage/assets/js/main.js')}}"></script>
	</body>
</html>
