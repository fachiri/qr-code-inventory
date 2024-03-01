@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Unit' => null,
    ],
])
@section('title', 'Satuan')
@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/select.bootstrap4.min.css') }}">
@endpush
@section('content')
	<div class="section-body">
		<div class="card shadow-lg text-dark">
			<div class="card-header d-flex justify-content-between">
				<h4>Tabel Unit</h4>
				<div class="d-flex justify-content-between">
					<a href="{{ route('dashboard.master.unit.create') }}" class="btn btn-primary mr-2">
						<i class="fas fa-plus"></i>
						Tambah Data
					</a>
					{{-- <a href="#" class="btn btn-success">
						<i class="fas fa-file-pdf"></i>
						PDF
					</a> --}}
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive text-dark">
					<table class="table-striped table" id="datatable">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Detail</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($units as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $item->name }}</td>
									<td>{{ $item->detail }}</td>
									<td>
										<a href="#" class="btn btn-secondary">Detail</a>
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
