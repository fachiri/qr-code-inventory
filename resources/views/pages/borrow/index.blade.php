@php
	$isMobile = (new \Jenssegers\Agent\Agent())->isMobile();
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Peminjaman' => null,
    ],
])
@section('title', 'Peminjaman')
@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/select.bootstrap4.min.css') }}">
@endpush
@section('content')
	<div class="section-body">
		<div class="card mb-4 border shadow-sm">
			<div class="card-header d-flex justify-content-between">
				<h4>Daftar Peminjaman</h4>
				@if (!$isMobile)
					<div class="d-flex">
						<a href="{{ route('dashboard.borrow.create') }}" class="btn btn-primary">
							<i class="fas fa-plus"></i>
							Pinjam Barang
						</a>
					</div>
				@endif
			</div>
			<div class="card-body">
				@if (!$isMobile)
					<div class="table-responsive">
						<table class="table-striped table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Peminjam</th>
									<th>Barang</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($borrows as $borrow)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $borrow->histories[0]->created_at->toDateString() }}</td>
										<td>
											<a href="{{ route('dashboard.user.show', $borrow->histories[0]->user->uuid) }}">{{ $borrow->histories[0]->user->name }}</a>
										</td>
										<td>
											<a href="{{ route('dashboard.master.subitem.show', $borrow->subitem->uuid) }}">{{ $borrow->subitem->item->name }} - {{ str_pad($borrow->subitem->number, 3, '0', STR_PAD_LEFT) }}</a>
										</td>
										<td>
											<x-badge value="{{ $borrow->histories[0]->status }}" :options="[
											    (object) [
											        'type' => 'primary',
											        'value' => App\Constants\StatusPeminjaman::PENDING,
											    ],
											    (object) [
											        'type' => 'success',
											        'value' => App\Constants\StatusPeminjaman::ACTIVE,
											    ],
											    (object) [
											        'type' => 'danger',
											        'value' => App\Constants\StatusPeminjaman::REJECTED,
											    ],
											    (object) [
											        'type' => 'secondary',
											        'value' => App\Constants\StatusPeminjaman::RETURNED,
											    ],
											]" />
										</td>
										<td>
											<a href="{{ route('dashboard.borrow.show', $borrow->uuid) }}" class="btn btn-secondary">Detail</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="d-flex">
						<a href="{{ route('dashboard.borrow.create') }}" class="btn btn-primary">
							<i class="fas fa-plus"></i>
							Pinjam Barang
						</a>
					</div>
				@endif
			</div>
		</div>
		@if ($isMobile)
			@foreach ($borrows as $borrow)
				<div class="card mb-4 border shadow-sm">
					<div class="card-header d-flex justify-content-between border-bottom">
						<h4>
							{{ $borrow->histories[0]->created_at->toDateString() }}
						</h4>
						<div class="d-flex justify-content-end gap-2">
							<a href="{{ route('dashboard.borrow.show', $borrow->uuid) }}" class="btn btn-secondary">Detail</a>
						</div>
					</div>
					<div class="card-body">
						<table class="table-striped table">
							<tr>
								<th>Peminjam</th>
								<td>
									<a href="{{ route('dashboard.user.show', $borrow->histories[0]->user->uuid) }}">{{ $borrow->histories[0]->user->name }}</a>
								</td>
							</tr>
							<tr>
								<th>Barang</th>
								<td>
									<a href="{{ route('dashboard.master.subitem.show', $borrow->subitem->uuid) }}">{{ $borrow->subitem->item->name }} - {{ str_pad($borrow->subitem->number, 3, '0', STR_PAD_LEFT) }}</a>
								</td>
							</tr>
							<tr>
								<th>Alasan</th>
								<td>{{ $borrow->desc }}</td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<x-badge value="{{ $borrow->histories[0]->status }}" :options="[
									    (object) [
									        'type' => 'primary',
									        'value' => App\Constants\StatusPeminjaman::PENDING,
									    ],
									    (object) [
									        'type' => 'success',
									        'value' => App\Constants\StatusPeminjaman::ACTIVE,
									    ],
									    (object) [
									        'type' => 'danger',
									        'value' => App\Constants\StatusPeminjaman::REJECTED,
									    ],
									    (object) [
									        'type' => 'secondary',
									        'value' => App\Constants\StatusPeminjaman::RETURNED,
									    ],
									]" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			@endforeach
		@endif
	</div>
@endsection
@push('scripts')
	<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.select.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/datatable.js') }}"></script>
@endpush
