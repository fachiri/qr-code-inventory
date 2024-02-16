@if (session('success'))
	<div class="alert alert-success alert-dismissible show fade">
		<div class="alert-body p-0">
			<button class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
			{{ session('success') }}
		</div>
	</div>
@endif

@if ($errors->any())
	<div class="alert alert-danger alert-dismissible show fade">
		<div class="alert-body p-0">
			<button class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
			<ul class="mb-0 pl-3">
				@foreach ($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif

@if (Session::has('error'))
	<div class="alert alert-danger alert-dismissible show fade">
		<div class="alert-body p-0">
			<button class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
			{{ Session::get('error') }}
		</div>
	</div>
@endif
