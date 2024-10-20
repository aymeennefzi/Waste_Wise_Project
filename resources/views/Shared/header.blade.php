<!--Start topbar header-->
<header class="topbar-nav">
	<nav class="navbar navbar-expand fixed-top">
		<ul class="navbar-nav mr-auto align-items-center">
			<li class="nav-item">
				<a class="nav-link toggle-menu" href="javascript:void();"><i class="icon-menu menu-icon"></i></a>
			</li>
		</ul>
		<ul class="navbar-nav align-items-center right-nav-link">
			<li class="nav-item dropdown-lg">
				<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-envelope-open-o"></i></a>
			</li>
			<li class="nav-item dropdown-lg">
				<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-bell-o"></i></a>
			</li>
			<li class="nav-item">
				<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
					<span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="dropdown-item user-details">
						<a href="javaScript:void();">
							<div class="media">
								<div class="avatar">
									<img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar">
								</div>
								<div class="media-body">
									<h6 class="mt-2 user-title">
									{{-- {{ Auth::user()->name }}									 --}}
								</h6>
								<p class="user-subtitle">
									{{-- {{ Auth::user()->email }}									 --}}
								</p>
								</div>
							</div>
						</a>
					</li>
					<li class="dropdown-divider"></li>
					<li class="dropdown-divider"></li>
					<li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
					<li class="dropdown-divider"></li>
					<li class="dropdown-divider"></li>
					<li class="dropdown-item">
						<form id="logout-form" method="POST" action="{{ route('logout') }}" x-data>
							@csrf
							<button type="submit" class="dropdown-item bg-danger-soft-hover" @click.prevent><i class="bi bi-power fa-fw me-2"></i>{{ __('Log Out') }}</button>
						</form>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</header>
<!--End topbar header-->