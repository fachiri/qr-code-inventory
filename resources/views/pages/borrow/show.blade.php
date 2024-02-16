@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Peminjaman' => route('dashboard.borrow.index'),
        $borrow->histories[0]->created_at->toDateString() => null,
    ],
])
@section('title', 'Detail Peminjaman')
@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/select.bootstrap4.min.css') }}">
@endpush
@section('content')
	<div class="section-body">
		<div class="card mb-4 border shadow-sm">
			<div class="card-header d-flex justify-content-between border-bottom">
				<h4>Rincian</h4>
				<div class="d-flex justify-content-end gap-2">
					<a href="{{ route('dashboard.borrow.edit', $borrow->uuid) }}" class="btn btn-warning btn-sm mr-2">
						<i class="fas fa-edit"></i>
						Edit
					</a>
				</div>
			</div>
			<div class="card-body">
				<table class="table-striped table">
					<tr>
						<th>Tanggal</th>
						<td>{{ $borrow->histories[0]->created_at->toDateString() }}</td>
					</tr>
					<tr>
						<th>Waktu</th>
						<td>{{ $borrow->histories[0]->created_at->toTimeString() }}</td>
					</tr>
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
		<div class="card mb-4 border shadow-sm">
			<div class="card-header d-flex justify-content-between border-bottom">
				<h4>Riwayat</h4>
			</div>
			<div class="card-body">
				bagian riwayat
			</div>
		</div>
	</div>
@endsection
@push('modals')
@endpush
@push('scripts')
	<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.select.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/datatable.js') }}"></script>
@endpush
