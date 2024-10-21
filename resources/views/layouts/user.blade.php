<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>WasteWise</title>
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/téléchargement.ico" />
		<!-- Dark mode -->
		<script>
			const storedTheme = localStorage.getItem("theme");
			const getPreferredTheme = () => {
				if (storedTheme) {
					return storedTheme;
				}
				return window.matchMedia("(prefers-color-scheme: light)").matches? "light": "light";
			};
			const setTheme = function (theme) {
				if (theme === "auto" &&window.matchMedia("(prefers-color-scheme: dark)").matches) {
					document.documentElement.setAttribute("data-bs-theme", "dark");
				}
				else {
					document.documentElement.setAttribute("data-bs-theme", theme);
				}
			};
			setTheme(getPreferredTheme());
			window.addEventListener("DOMContentLoaded", () => {
				var el = document.querySelector(".theme-icon-active");
				if (el != "undefined" && el != null) {
					const showActiveTheme = (theme) => {
						const activeThemeIcon = document.querySelector(".theme-icon-active use");
						const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`);
						const svgOfActiveBtn = btnToActive.querySelector(".mode-switch use").getAttribute("href");
						document.querySelectorAll("[data-bs-theme-value]").forEach((element) => {
							element.classList.remove("active");
						});
						btnToActive.classList.add("active");
						activeThemeIcon.setAttribute("href", svgOfActiveBtn);
					};
					window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", () => {
						if (storedTheme !== "light" || storedTheme !== "dark") {
							setTheme(getPreferredTheme());
						}
					});
					showActiveTheme(getPreferredTheme());
					document.querySelectorAll("[data-bs-theme-value]").forEach((toggle) => {
						toggle.addEventListener("click", () => {
							const theme = toggle.getAttribute("data-bs-theme-value");
							localStorage.setItem("theme", theme);
							setTheme(theme);
							showActiveTheme(theme);
						});
					});
				}
			});
		</script>
		<!-- Google Font -->
		<link rel="preconnect" href="https://fonts.googleapis.com/" />
		<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap"/>
		<!-- Plugins CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/font-awesome/css/all.min.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}"/>
		<link rel="stylesheet" type="text/css" ref="{{ asset('front_office/assets/vendor/tiny-slider/tiny-slider.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/glightbox/css/glightbox.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/apexcharts/css/apexcharts.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css')}}"/>
		<link rel="stylesheet" type="text/css"  href="{{ asset('front_office/assets/vendor/choices/css/choices.min.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/quill/css/quill.snow.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/vendor/stepper/css/bs-stepper.min.css')}}"/>
		<!-- Theme CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('front_office/assets/css/style.css')}}" />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-7N7LGGGWT1"></script>
		<!-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> -->

		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());
			gtag("config", "G-7N7LGGGWT1");
		</script>
		<!-- password -->
		<script>
			p = true;
			function Changer() {
				if (p) {
					document.getElementById("inputPassword5").setAttribute("type", "text");
					p = false;
				}
				else {
					document.getElementById("inputPassword5").setAttribute("type", "password");
					p = true;
				}
			}
		</script>
		<!------------------------------------- Template Css Styles ----------------------------------------------->
		<link rel="stylesheet" href=".{{ asset('front_office/assets/Template/css/style.css')}}" type="text/css">
		<!-------------------------------------End Template Css Styles ----------------------------------------------->
		 <!-- CSS de Toastr -->
		 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<!-- JS de Pusher -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- Assurez-vous que jQuery est inclus si vous l'utilisez -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS de Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
        // Activer le log dans la console pour Pusher
        Pusher.logToConsole = true;

        // Initialiser Pusher avec votre clé et le cluster
        var pusher = new Pusher('d384ed014b78d9e69093', {
            cluster: 'eu', // Mettez à jour avec le cluster que vous utilisez
            forceTLS: true
        });

        // S'abonner au canal
        var channel = pusher.subscribe('wastetips');

        // Écouter l'événement de création de WasteTip
        channel.bind('App\\Events\\PostCreated', function(data) {
            console.log(data); // Vérifiez la structure des données
            if (data && data.title) {
                // Afficher la notification Toastr
                toastr.success('Un nouveau wastetip a été créé : ' + data.title, 'Nouveau WasteTip', {
                    positionClass: 'toast-top-right',
                    timeOut: 6000, // Durée d'affichage de la notification
                    extendedTimeOut: 1000, // Durée d'affichage à l'extension
                    progressBar: true,
                    closeButton: true,
                    toastClass: 'toast-success',
                });
            } else {
                console.error('Invalid data structure received:', data);
            }
        });
    </script>

    <style>
        /* Personnalisation de la notification Toastr */
        .toast-success {
            background-color: green; /* Fond vert */
            color: white; /* Texte blanc */
            font-weight: bold; /* Écriture en gras */
        }
    </style>
	</head>

	<body>


		<!-- Header START -->
		<header class="navbar-light navbar-sticky">
			<!-- Logo Nav START -->
			<nav class="navbar navbar-expand-xl" style="background-color: #396084">
				<div class="container">
					<!-- Logo START -->
					<a class="navbar-brand d-flex align-items-center" href="index.html">
						<img src="{{ asset('LandingPage/assets/img/logo/loder1.png') }}" class="logo-img" alt="logo" width="40" height="auto">
						<span class="ms-2" style="font-size: 24px; color: #206B75;">Waste wise</span> <!-- Ajoutez votre nom ici -->
					</a>
					<!-- Logo END -->

					<!-- Responsive navbar toggler -->
					<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-animation">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>

					<!-- Profile START -->
					<div class="dropdown ms-1 ms-lg-0">
					<span class="h6 m-3" style="font-size: 18px; color: #404040; margin-left: 10px;">{{ Auth::user()->name }}</span>

					<a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false"><img class="avatar-img rounded-circle" src="{{ asset(Auth::user()->profile_photo_path) }}"alt="avatar"></a>
						<ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
							<!-- Profile info -->
							<li class="px-3 mb-3">
								<div class="d-flex align-items-center">
									<!-- Avatar -->
									<div class="avatar me-3">
										<img class="avatar-img rounded-circle shadow" src="{{ asset(Auth::user()->profile_photo_path) }}" alt="avatar">
									</div>

									<div>
										<a class="h6" href="#">{{ Auth::user()->name }}</a>
										<p class="small m-0">
										{{ Auth::user()->email }}
										</p>
									</div>
								</div>
							</li>
							<li><hr class="dropdown-divider"></li>
							<!-- Links -->
							<li>
								<a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a>
							</li>
							<!-- Authentication -->
							<li>
								<form id="logout-form" method="POST" action="{{ route('logout') }}" x-data>
									@csrf
									<button type="submit" class="dropdown-item bg-danger-soft-hover" @click.prevent><i class="bi bi-power fa-fw me-2"></i>{{ __('Log Out') }}</button>
								</form>
							</li>
							<li><hr class="dropdown-divider"></li>
							<!-- Dark mode options START -->
							<li>
								<div class="bg-light dark-mode-switch theme-icon-active d-flex align-items-center p-1 rounded mt-2">
									<button type="button" class="btn btn-sm mb-0" data-bs-theme-value="light">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun fa-fw mode-switch" viewBox="0 0 16 16">
											<path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
											<use href="#"></use>
										</svg>
										Light
									</button>
									<button type="button" class="btn btn-sm mb-0" data-bs-theme-value="dark">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch" viewBox="0 0 16 16">
											<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
											<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
											<use href="#"></use>
										</svg>
										Dark
									</button>
									<button type="button" class="btn btn-sm mb-0 active" data-bs-theme-value="auto">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch" viewBox="0 0 16 16">
											<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
											<use href="#"></use>
										</svg>
										Auto
									</button>
								</div>
							</li>
							<!-- Dark mode options END-->
							 
						</ul>

					</div>
					<!-- Profile START -->
				</div>
			</nav>
			<!-- Logo Nav END -->
		</header>
		<!-- Header END -->
		<main>
			<!-- =======================Page Banner START -->
			<section class="pt-0">
				<!-- Main banner frontground image -->
				{{-- <div class="px-0">
					<div class="bg-primary h-100px h-md-100px rounded-0"  </div>
				</div> --}}
			</div>
			</section>
			<section class="pt-0">
				<div class="row">
					<!-- Left sidebar START -->
					<div class="col-xl-2 ps-5">
						<!-- Responsive offcanvas body START -->
						<div class="offcanvas-xl offcanvas-end"tabindex="-1"id="offcanvasSidebar">
							<!-- Offcanvas header -->
							<div class="offcanvas-header bg-light">
								<h5 class="offcanvas-title" id="offcanvasNavbarLabel">
									Mon profil
								</h5>
								<button type="button"class="btn-close"data-bs-dismiss="offcanvas"data-bs-target="#offcanvasSidebar"aria-label="Close"></button>
							</div>
							<!-- Offcanvas body -->
							<div class="offcanvas-body p-3 p-xl-0">
								<div class="bg-dark border rounded-3 pb-0 p-3 w-100">
									<!-- Dashboard menu -->
									<div class="list-group list-group-dark list-group-borderless">
										<a class="list-group-item" href="{{ route('communities.user.index') }}">
											<i class="fas fa-users fa-fw me-2"></i> Community
										</a>
																			
										<a class="list-group-item" href="/user-dashboard/WasteTips"><i class="fas fa-plus fa-fw"  ></i>Waste tips</a>

										</a>										
										
                                        <a class="list-group-item" href="{{ route('events.index2') }}">
                                            <i class="fas fa-calendar-alt fa-fw me-2"></i>Event
                                        </a>
                                        <a class="list-group-item" href="{{ route('tasks.index2') }}">
                                            <i class="fas fa-tasks fa-fw me-2"></i>Tasks
                                        </a>

										<a class="list-group-item" href="{{ route('recycling_centers.index')}}"><i class="fas fa-stream"></i>Recycle Center</a>
										<a class="list-group-item" href="{{ route('materials.user')}}"><i class="fas fa-stream"></i>Materials</a>
										
										
										<a class="list-group-item" href="/donations"><i class="fas fa-donate fa-fw me-2"></i>Donations</a>
										<a class="list-group-item" href="/campaigns"><i class="fas fa-bullhorn fa-fw me-2"></i>Campaigns</a>
                                        <a class="list-group-item" href="/item-posts"><i class="fas fa-bullhorn fa-fw me-2"></i>Posts</a>


										<a class="list-group-item text-danger bg-danger-soft-hover"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a>
									</div>
   
    
    


								</div>	
							</div>
						</div>
						<!-- Responsive offcanvas body END -->
					</div>
					<!-- Left sidebar END -->
					<!-- Main content START -->
					<div class="col-xl-9 mb-8 ">

          @yield('content')


					</div>
					<!-- Main content END -->
				</div>
				<!-- Row END -->
			</section>
		</main>
		<div>
		@include('Shared.footer-front')
	   </div>
		<!-- Bootstrap JS -->
		<script src="{{ asset('front_office/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
		<!-- Vendors -->
		<script src="{{ asset('front_office/assets/vendor/tiny-slider/tiny-slider.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/glightbox/js/glightbox.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/purecounterjs/dist/purecounter_vanilla.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/apexcharts/js/apexcharts.min.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/choices/js/choices.min.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/quill/js/quill.min.js')}}"></script>
		<script src="{{ asset('front_office/assets/vendor/stepper/js/bs-stepper.min.js')}}"></script>
		<!-- Template Functions -->
		<script src="{{ asset('front_office/assets/js/functions.js')}}"></script>
		
	</body>
</html>
