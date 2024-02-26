<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
		@env('local')
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> {{-- ngrok config --}}
		@endenv
		<title>@yield('title') | {{ config('app.name') }}</title>
		<link rel="stylesheet" href="{{ asset('modules/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('modules/fontawesome.all.min.css') }}">
		@stack('styles')
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('css/components.css') }}">
		<link rel="shortcut icon" href="{{asset('assets/UNG.png')}}" type="image/x-icon">
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'UA-94034622-3');
		</script>
	</head>

	<body class="{{ (new \Jenssegers\Agent\Agent())->isMobile() ? 'sidebar-gone' : '' }}">
		<div id="app">
			<div class="main-wrapper main-wrapper-1">
				<div class="navbar-bg"></div>
				<nav class="navbar navbar-expand-lg main-navbar">
					<form class="form-inline mr-auto">
						<ul class="navbar-nav mr-3">
							<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
							{{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
						</ul>
						{{-- <div class="search-element">
							<input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
							<button class="btn" type="submit"><i class="fas fa-search"></i></button>
							<div class="search-backdrop"></div>
							<div class="search-result">
								<div class="search-header">
									Histories
								</div>
								<div class="search-item">
									<a href="#">How to hack NASA using CSS</a>
									<a href="#" class="search-close"><i class="fas fa-times"></i></a>
								</div>
								<div class="search-item">
									<a href="#">Kodinger.com</a>
									<a href="#" class="search-close"><i class="fas fa-times"></i></a>
								</div>
								<div class="search-item">
									<a href="#">#Stisla</a>
									<a href="#" class="search-close"><i class="fas fa-times"></i></a>
								</div>
								<div class="search-header">
									Result
								</div>
								<div class="search-item">
									<a href="#">
										<img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
										oPhone S9 Limited Edition
									</a>
								</div>
								<div class="search-item">
									<a href="#">
										<img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
										Drone X2 New Gen-7
									</a>
								</div>
								<div class="search-item">
									<a href="#">
										<img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
										Headphone Blitz
									</a>
								</div>
								<div class="search-header">
									Projects
								</div>
								<div class="search-item">
									<a href="#">
										<div class="search-icon bg-danger mr-3 text-white">
											<i class="fas fa-code"></i>
										</div>
										Stisla Admin Template
									</a>
								</div>
								<div class="search-item">
									<a href="#">
										<div class="search-icon bg-primary mr-3 text-white">
											<i class="fas fa-laptop"></i>
										</div>
										Create a new Homepage Design
									</a>
								</div>
							</div>
						</div> --}}
					</form>
					<ul class="navbar-nav navbar-right">
						<li class="dropdown dropdown-list-toggle">
							{{-- <x-main.messages /> --}}
						</li>
						<li class="dropdown dropdown-list-toggle">
							{{-- <x-main.notifications /> --}}
						</li>
						<li class="dropdown">
							<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
								<img alt="image" src="{{ auth()->user()->avatar ?? asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
								<div class="d-sm-none d-lg-inline-block">{{ explode(' ', auth()->user()->name)[0] }}</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-title">Logged in 5 min ago</div>
								<a href="features-profile.html" class="dropdown-item has-icon">
									<i class="far fa-user"></i> Profile
								</a>
								<a href="features-activities.html" class="dropdown-item has-icon">
									<i class="fas fa-bolt"></i> Activities
								</a>
								<a href="features-settings.html" class="dropdown-item has-icon">
									<i class="fas fa-cog"></i> Settings
								</a>
								<div class="dropdown-divider"></div>
								<a href="{{ route('dashboard.logout.process') }}" class="dropdown-item has-icon text-danger">
									<i class="fas fa-sign-out-alt"></i> Logout
								</a>
								{{-- <x-form.confirm
									class="dropdown-item has-icon text-danger"
									method="POST"
									:action="route('dashboard.logout.process')"
									label="Logout?"
									id="logout-button"
								>
									<i class="fas fa-sign-out-alt"></i> Logout
								</x-form.confirm> --}}
							</div>
						</li>
					</ul>
				</nav>
				<div class="main-sidebar sidebar-style-2">
					<aside id="sidebar-wrapper">
						<div class="sidebar-brand">
							<a href="index.html">{{ config('app.name') }}</a>
						</div>
						<div class="sidebar-brand sidebar-brand-sm">
							<a href="index.html">{{ substr(config('app.name'), 0, 2) }}</a>
						</div>
						<x-main.sidebar />
					</aside>
				</div>

				<!-- Main Content -->
				<div class="main-content">
					<section class="section">
						<div class="section-header mb-0">
							<h1>@yield('title')</h1>
							<div class="section-header-breadcrumb">
								@foreach ($breadcrumbs as $label => $url)
									<div class="breadcrumb-item">
										@if ($url)
											<a href="{{ $url }}">{{ $label }}</a>
										@else
											{{ $label }}
										@endif
									</div>
								@endforeach
							</div>
						</div>
						<x-main.alerts />
						@yield('content')
					</section>
				</div>
				<footer class="main-footer">
					<div class="footer-left">
						<x-main.footer />
					</div>
					<div class="footer-right">

					</div>
				</footer>
			</div>

			{{-- Modal --}}
			@stack('modals')
		</div>

		<script src="{{ asset('modules/jquery.min.js') }}"></script>
		<script src="{{ asset('modules/popper.js') }}"></script>
		<script src="{{ asset('modules/tooltip.js') }}"></script>
		<script src="{{ asset('modules/bootstrap.min.js') }}"></script>
		<script src="{{ asset('modules/jquery.nicescroll.min.js') }}"></script>
		<script src="{{ asset('modules/moment.min.js') }}"></script>
		<script src="{{ asset('js/stisla.js') }}"></script>

		@stack('scripts')

		<script src="{{ asset('js/scripts.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
	</body>

</html>
