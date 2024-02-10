@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Pengguna' => null,
    ],
])
@section('title', 'Pengguna')
@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/select.bootstrap4.min.css') }}">
@endpush
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Tabel Pengguna</h4>
				<div class="d-flex justify-content-between">
					<x-modal id-button="modal-button-filter" id-content="modal-filter">
						<form action="{{ route('dashboard.user.index') }}" method="GET">
							<x-form.select name="role" label="Role" class="w-100" :options="[
							    (object) [
							        'label' => 'Admin',
							        'value' => 'Admin',
							    ],
							    (object) [
							        'label' => 'Dosen',
							        'value' => 'Dosen',
							    ],
							    (object) [
							        'label' => 'Mahasiswa',
							        'value' => 'Mahasiswa',
							    ],
							]" />
							<div class="pt-2">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</x-modal>
					<a href="{{ route('dashboard.user.create') }}" class="btn btn-primary">
						<i class="fas fa-plus"></i>
						Tambah Data
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table-striped table" id="datatable">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->user->name }}</td>
									<td>
										<x-badge value="{{ $item->user->role }}" :options="[
										    (object) [
										        'type' => 'primary',
										        'value' => 'Admin',
										    ],
										    (object) [
										        'type' => 'secondary',
										        'value' => 'Dosen',
										    ],
										    (object) [
										        'type' => 'dark',
										        'value' => 'Mahasiswa',
										    ],
										]" />
									</td>
									<td>
										<a href="{{ route('dashboard.user.show', $item->user->uuid) }}" class="btn btn-secondary">Detail</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.select.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/datatable.js') }}"></script>
@endpush
