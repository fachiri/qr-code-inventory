@php
	$currentStatus = $borrow->histories()->latest()->first()->status;
	$_PENDING = \App\Constants\StatusPeminjaman::PENDING;
	$_APPROVED = \App\Constants\StatusPeminjaman::APPROVED;
	$_REJECTED = \App\Constants\StatusPeminjaman::REJECTED;
	$_CANCELED = \App\Constants\StatusPeminjaman::CANCELED;
	$_RETURNED = \App\Constants\StatusPeminjaman::RETURNED;
@endphp
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
					@if ($currentStatus == $_PENDING)
						@if (auth()->user()->admin)
							<x-form.confirm :action="route('dashboard.borrow.reject', $borrow->uuid)" id="tolak-peminjaman" class="btn-danger" label="Tolak Peminjaman">
								<i class="fas fa-times"></i>
								Tolak
							</x-form.confirm>
							<x-form.confirm :action="route('dashboard.borrow.approve', $borrow->uuid)" id="setujui-peminjaman" class="btn-success ml-2" label="Setujui Peminjaman">
								<i class="fas fa-times"></i>
								Setujui
							</x-form.confirm>
						@else
							<x-form.confirm :action="route('dashboard.borrow.cancel', $borrow->uuid)" id="batalkan-peminjaman" class="btn-danger" label="Batalkan Peminjaman">
								<i class="fas fa-times"></i>
								Batalkan
							</x-form.confirm>
						@endif
					@endif
					@if ($currentStatus == $_APPROVED && auth()->user()->admin)
						<x-form.confirm :action="route('dashboard.borrow.return', $borrow->uuid)" id="barang-dikembalikan" class="btn-secondary" label="Barang telah dikembalikan">
							<i class="fas fa-undo"></i>
							Dikembalikan
						</x-form.confirm>
					@endif
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
					@if (auth()->user()->admin)
						<tr>
							<th>Peminjam</th>
							<td>
								<a href="{{ route('dashboard.user.show', $borrow->user->uuid) }}">{{ $borrow->user->name }}</a>
							</td>
						</tr>
					@endif
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
							<x-badge value="{{ $currentStatus }}" :options="[
							    (object) [
							        'type' => 'primary',
							        'value' => $_PENDING,
							    ],
							    (object) [
							        'type' => 'success',
							        'value' => $_APPROVED,
							    ],
							    (object) [
							        'type' => 'danger',
							        'value' => $_REJECTED,
							    ],
							    (object) [
							        'type' => 'danger',
							        'value' => $_CANCELED,
							    ],
							    (object) [
							        'type' => 'secondary',
							        'value' => $_RETURNED,
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
				<div class="activities">
					@foreach ($borrow->histories as $history)
						<div class="activity">
							<x-icon.activity :value="$history->status" />
							<div class="activity-detail">
								<div class="mb-2">
									<span class="text-job text-primary">{{ $history->created_at->diffForHumans() }}</span>
									<span class="bullet"></span>
									<span class="text-job">{{ $history->status }}</span>
								</div>
								@if (auth()->user()->admin)
									@if ($history->status == $_PENDING)
										<p>Permintaan telah diajukan. Selanjutnya menunggu persetujuan admin.</p>
									@elseif($history->status == $_APPROVED)
										<p>Permintaan telah disetujui oleh <a href="{{ route('dashboard.user.show', $history->admin->user->uuid) }}">{{ $history->admin->user->name }}</a>. Pengguna atas nama <a href="{{ route('dashboard.user.show', $history->borrow->user->uuid) }}">{{ $history->borrow->user->name }}</a> akan mengambil barang yang dipinjam.</p>
									@elseif($history->status == $_REJECTED)
										<p>Permintaan telah ditolak oleh <a href="{{ route('dashboard.user.show', $history->admin->user->uuid) }}">{{ $history->admin->user->name }}</a>.</p>
									@elseif($history->status == $_RETURNED)
										<p>Barang yang dipinjam telah dikembalikan.</p>
									@elseif($history->status == $_CANCELED)
										<p><a href="{{ route('dashboard.user.show', $history->borrow->user->uuid) }}">{{ $history->borrow->user->name }}</a> telah membatalkan peminjaman.</p>
									@endif
								@else
									@if ($history->status == $_PENDING)
										<p>Permintaan anda telah diajukan. Selanjutnya menunggu persetujuan admin.</p>
									@elseif($history->status == $_APPROVED)
										<p>Permintaan anda telah disetujui oleh <a href="{{ route('dashboard.user.show', $history->admin->user->uuid) }}">{{ $history->admin->user->name }}</a>. Silakan ambil barang yang Anda pinjam.</p>
									@elseif($history->status == $_REJECTED)
										<p>Permintaan anda telah ditolak oleh <a href="{{ route('dashboard.user.show', $history->admin->user->uuid) }}">{{ $history->admin->user->name }}</a>. Silakan hubungi admin untuk informasi lebih lanjut.</p>
									@elseif($history->status == $_RETURNED)
										<p>Barang yang Anda pinjam telah dikembalikan. Terima kasih telah menggunakan layanan kami.</p>
									@elseif($history->status == $_CANCELED)
										<p>Anda telah membatalkan peminjaman.</p>
									@endif
								@endif
							</div>
						</div>
					@endforeach
				</div>
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
