@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Pengguna' => route('dashboard.user.index'),
        'Tambah Data' => null,
    ],
])
@section('title', 'Tambah Pengguna')
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Tambah Pengguna</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.user.store', ['role' => request('role')]) }}" method="POST">
					@csrf
					<x-form.select name="role" label="Pilih role" class="form-group" :value="request('role')" :options="[
					    (object) [
					        'label' => 'Admin',
					        'value' => 'Admin',
					    ],
					    (object) [
					        'label' => 'Dosen',
					        'value' => 'Lecturer',
					    ],
					    (object) [
					        'label' => 'Mahasiswa',
					        'value' => 'Student',
					    ],
					]" />
					<x-form.input name="name" label="Nama Lengkap" class="form-group" />
					@if (request('role') == 'Admin')
						<x-form.input name="username" label="Username" class="form-group" />
					@endif
					@if (request('role') == 'Lecturer')
						<x-form.input name="nidn" label="Nomor Induk Dosen Nasional" class="form-group" />
					@endif
					@if (request('role') == 'Student')
						<x-form.input name="nim" label="Nomor Induk Mahasiswa" class="form-group" />
					@endif
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script>
		$('#role').on("select2:selecting", function(e) {
			let selectedValue = e.params.args.data.id;

			let currentUrl = new URL(window.location.href);

			currentUrl.searchParams.set('role', selectedValue);

			window.location.href = currentUrl.href;
		});
	</script>
@endpush
