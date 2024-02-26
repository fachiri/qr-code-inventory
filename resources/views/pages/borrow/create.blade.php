@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Peminjaman' => route('dashboard.borrow.index'),
        'Pinjam Barang' => null,
    ],
])
@section('title', 'Buat Peminjaman')
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Buat Peminjaman</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.borrow.store') }}" method="POST">
					@csrf
					<x-form.select name="subitem_uuid" label="Pilih Barang" class="form-group" :options="$subitems->map(function ($subitem) {
					    return (object) ['label' => $subitem->item->name . ' | ' . $subitem->item->code . ' ' . str_pad($subitem->number, 3, '0', STR_PAD_LEFT), 'value' => $subitem->uuid];
					})" />
					<x-form.textarea name="desc" label="Tujuan Peminjaman" placeholder="Isi tujuan peminjaman" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
@endpush
