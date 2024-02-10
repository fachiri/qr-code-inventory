@extends('layouts.auth')
@section('title', 'Login')
@section('content')
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
			<div class="login-brand">
				<h3>{{ config('app.name') }}</h3>
			</div>

			<div class="card card-primary">
				<div class="card-header">
					<h4>Login</h4>
				</div>

				<div class="card-body">
					<x-main.alerts />
					<form method="POST" action="{{ route('auth.login.process') }}">
						@csrf
						<x-form.select name="role" label="Login sebagai" class="form-group" tabindex="1" :options="[
						    (object) [
						        'label' => 'Admin',
						        'value' => 'Admin'
						    ],
						    (object) [
						        'label' => 'Dosen',
						        'value' => 'Dosen'
						    ],
						    (object) [
						        'label' => 'Mahasiswa',
						        'value' => 'Mahasiswa'
						    ]
						]" />
						<x-form.input name="username" label="Username" class="form-group" autocomplete="username" tabindex="2" />
						<div class="form-group">
							<div class="d-block">
								<label for="password" class="control-label">Password</label>
								<div class="float-right">
									<a href="auth-forgot-password.html" class="text-small">
										Lupa Password?
									</a>
								</div>
							</div>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" tabindex="3">
							@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
								<label class="custom-control-label" for="remember-me">Ingat Saya</label>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
								Login
							</button>
						</div>
					</form>
				</div>
			</div>
			{{-- <div class="text-muted mt-1 text-center">
				Don't have an account? <a href="auth-register.html">Create One</a>
			</div> --}}
			<div class="simple-footer">
				<x-main.footer />
			</div>
		</div>
	</div>
@endsection
