<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>WasteWise</title>
		<!-- Favicon -->
<<<<<<< HEAD
		<link rel="shortcut icon" href="assets/images/téléchargement.ico" />
		{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css> --}}

=======
		<link rel="icon" href="{{ asset('Back_office/assets/images/loder.png')}}" type="image/x-icon">
>>>>>>> 87dc30a37e1b1dc11d64a82be1577b94a8c5de97
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
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<style>
		.nav-link-label {
    position: relative;
    display: inline-block;
    color: #ffffff;
    text-decoration: none;
}

.fa-bell {
    font-size: 18px;
    color: #ffffff;
}

.notif-count {
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: #ff4757;
    color: #ffffff;
    font-size: 12px;
    padding: 2px 5px;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.dropdown-menu {
    width: 300px;
    padding: 0;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-header {
    background-color: #f8f9fa;
    padding: 10px;
    font-weight: bold;
    color: #343a40;
    border-bottom: 1px solid #e9ecef;
}

.notification-item {
    padding: 10px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-decoration: none;
    color: #343a40;
}

.notification-item:hover {
    background-color: #f1f1f1;
}

.media-body {
    flex-grow: 1;
    margin-right: 10px;
}

.media-heading {
    font-size: 14px;
    font-weight: bold;
    margin: 0;
}

.notification-text {
    font-size: 14px;
    color: #343a40;
}

.media-meta {
    font-size: 10px;
    color: #adb5bd;
    text-align: right;
}

.dropdown-menu-footer {
    padding: 10px;
    text-align: center;
    background-color: #f8f9fa;
    border-top: 1px solid #e9ecef;
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
					<a class="navbar-brand" href="index.html">
						<img src="{{ asset('LandingPage/assets/img/logo/loder1.png') }}" class="logo-img" alt="logo" width="40" height="auto">
<<<<<<< HEAD
=======
						<span class="ms-2" style="font-size: 24px; color: #fffff;">Waste wise</span> <!-- Ajoutez votre nom ici -->
>>>>>>> 87dc30a37e1b1dc11d64a82be1577b94a8c5de97
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
<<<<<<< HEAD
			
					<!-- Navbar collapse START -->
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<!-- Profile START -->
						<div class="dropdown ms-auto me-3">
							<a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
								<img class="avatar-img rounded-circle" src="{{ asset(Auth::user()->profile_photo_path) }}" alt="avatar">
							</a>
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
											<p class="small m-0">{{ Auth::user()->email }}</p>
										</div>
=======

					<!-- Profile START -->
					<div class="dropdown ms-1 ms-lg-0">
					<span class="h6 m-3" style="font-size: 18px; color: #fffff; margin-left: 10px;">{{ Auth::user()->name }}</span>

					<a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false"><img class="avatar-img rounded-circle" src="{{ asset(Auth::user()->profile_photo_path) }}"alt="avatar"></a>
						<ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
							<!-- Profile info -->
							<li class="px-3 mb-3">
								<div class="d-flex align-items-center">
									<!-- Avatar -->
									<div class="avatar me-3">
										<img class="avatar-img rounded-circle shadow" src="{{ asset(Auth::user()->profile_photo_path) }}" alt="avatar">
>>>>>>> 87dc30a37e1b1dc11d64a82be1577b94a8c5de97
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
										<button type="submit" class="dropdown-item bg-danger-soft-hover" @click.prevent>
											<i class="bi bi-power fa-fw me-2"></i>{{ __('Log Out') }}
										</button>
									</form>
								</li>
								<li><hr class="dropdown-divider"></li>
								<!-- Dark mode options START -->
								<li>
									<div class="bg-light dark-mode-switch theme-icon-active d-flex align-items-center p-1 rounded mt-2">
										<button type="button" class="btn btn-sm mb-0" data-bs-theme-value="light">
											<i class="bi bi-sun fa-fw mode-switch"></i> Light
										</button>
										<button type="button" class="btn btn-sm mb-0" data-bs-theme-value="dark">
											<i class="bi bi-moon-stars fa-fw mode-switch"></i> Dark
										</button>
										<button type="button" class="btn btn-sm mb-0 active" data-bs-theme-value="auto">
											<i class="bi bi-circle-half fa-fw mode-switch"></i> Auto
										</button>
									</div>
								</li>
								<!-- Dark mode options END -->
							</ul>
						</div>
						<!-- Profile END -->
			
						@auth
						<!-- Notifications START -->
						<div class="dropdown ms-3">
							<a class="nav-link nav-link-label" href="#" data-bs-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge badge-pill badge-danger badge-glow notif-count" data-count="0">0</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li class="dropdown-header">
									Notifications
								</li>
								<li class="media-list w-100 scrollable-container">
									<!-- Notifications will be dynamically inserted here -->
								</li>
								<li class="dropdown-menu-footer">
									<a class="dropdown-item text-muted" href="#">View All Notifications</a>
								</li>
							</ul>
						</div>
						
						<audio id="notification-sound" src="notification.mp3" preload="auto"></audio>
						
						<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
						<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
						<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    var notificationsWrapper = $('.dropdown');
    var notificationsToggle = notificationsWrapper.find('a[data-bs-toggle]');
    var notificationsCountElem = notificationsToggle.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('li.scrollable-container');
    var notificationSound = document.getElementById('notification-sound');

    // Function to fetch unread notifications
    function fetchUnreadNotifications() {
        $.ajax({
            url: '/notifications/unread', // Use the route defined in web.php
            method: 'GET',
            success: function(data) {
                notificationsCount = data.unread_count; // Set the unread notifications count
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);

                // Clear existing notifications before appending new ones
                notifications.empty(); // Clear previous notifications

                // Only display the last 4 viewed notifications
                var recentNotifications = data.notifications.slice(0, 4);

                // Iterate through the last 4 viewed notifications and append them
                recentNotifications.forEach(function(notification) {
                    var notificationHtml = `
                    <a href="/recycling-centers/${notification.item}" class="notification-item" data-id="${notification.id}">
                        <div class="media">
                            <div class="media-body">
                                <h6 class="media-heading text-right">${notification.user_name}</h6>
                                <p class="notification-text font-small-3 text-muted text-right">${notification.action} ${notification.item}</p>
                                <small>
                                    <p class="media-meta text-muted text-right">${notification.created_at}</p>
                                </small>
                            </div>
                        </div>
                    </a>`;
                    
                    notifications.append(notificationHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch notifications:', error);
            }
        });
    }

    // Function to mark notifications as read
    function markNotificationsAsRead() {
        $.ajax({
            url: '/mark-notifications-read', // Your route for marking notifications as read
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                console.log('Notifications marked as read:', response);
                // Reset notification count and update UI
                notificationsCount = 0;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                fetchUnreadNotifications(); // Refresh notifications list
            },
            error: function(xhr, status, error) {
                console.error('Failed to mark notifications as read:', error);
            }
        });
    }

    // Fetch unread notifications when the page loads
    $(document).ready(function() {
        fetchUnreadNotifications();

        // Mark notifications as read when the dropdown is opened
        notificationsToggle.on('click', function() {
            markNotificationsAsRead();
        });
    });

    // Initialize Pusher
    var pusher = new Pusher('713c3e1ae772cf95ca43', {
        cluster: 'mt1',
        encrypted: true
    });

    // Subscribe to the 'new-notification' channel
    var channel = pusher.subscribe('new-notification');

    // Handle new notifications
    channel.bind('App\\Events\\NewNotification', function(data) {
        var existingNotifications = notifications.html();

        // Create HTML for the new notification
        var newNotificationHtml = `
        <a href="/recycling-centers/${data.item}" class="notification-item">
            <div class="media">
                <div class="media-body">
                    <h6 class="media-heading text-right">${data.user_name}</h6>
                    <p class="notification-text font-small-3 text-muted text-right">${data.action} ${data.item}</p>
                    <small>
                        <p class="media-meta text-muted text-right">${data.date} - ${data.time}</p>
                    </small>
                </div>
            </div>
        </a>`;

        // Insert the new notification at the top
        notifications.html(newNotificationHtml + existingNotifications);

        // Increment the notifications count
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);

        // Play notification sound
        notificationSound.play().catch(function(error) {
            console.error('Failed to play sound:', error);
        });
    });
</script>

						<!-- Notifications END -->
						@endauth
					</div>
					<!-- Navbar collapse END -->
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
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
		{{-- <script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

			// Enable pusher logging - don't include this in production
			Pusher.logToConsole = true;
		
			var pusher = new Pusher('713c3e1ae772cf95ca43', {
			  cluster: 'mt1'
			});
		
		  </script> --}}
		  	{{-- <script src="{{asset('js/pusherNotification.js')}}"></script> --}}
		  <!-- Include jQuery -->

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

	</body>
</html>
