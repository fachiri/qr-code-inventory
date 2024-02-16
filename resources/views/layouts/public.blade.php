<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
		@env('local')
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> {{-- ngrok config --}}
		@endenv
		<title>@yield('title') | {{ config('app.name') }}</title>

		<!-- General CSS Files -->
		<link rel="stylesheet" href="{{ asset('modules/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('modules/fontawesome.all.min.css') }}">

		<!-- CSS Libraries -->
		@stack('styles')

		<!-- Template CSS -->
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('css/components.css') }}">
		<!-- Start GA -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'UA-94034622-3');
		</script>
		<!-- /END GA -->
	</head>

	<body>
		<div id="app">
			@yield('content')
			@stack('modals')
		</div>

		<!-- General JS Scripts -->
		<script src="{{ asset('modules/jquery.min.js') }}"></script>
		<script src="{{ asset('modules/popper.js') }}"></script>
		<script src="{{ asset('modules/tooltip.js') }}"></script>
		<script src="{{ asset('modules/bootstrap.min.js') }}"></script>
		<script src="{{ asset('modules/jquery.nicescroll.min.js') }}"></script>
		<script src="{{ asset('modules/moment.min.js') }}"></script>
		<script src="{{ asset('js/stisla.js') }}"></script>

		<!-- JS Libraies -->
		@stack('scripts')

		<!-- Page Specific JS File -->

		<!-- Template JS File -->
		<script src="{{ asset('js/scripts.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
	</body>

</html>
