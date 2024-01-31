@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        $item->code => null,
    ],
])
@section('title', 'Detail ' . $item->name)
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Detail Barang</h4>
				<div class="d-flex justify-content-end mb-4 gap-2">
					<a href="{{ route('dashboard.master.item.print', $item->uuid) }}" class="btn btn-primary btn-sm mr-2">
						<i class="fas fa-print"></i>
						Cetak
					</a>
					<a href="{{ route('dashboard.master.item.edit', $item->uuid) }}" class="btn btn-warning btn-sm mr-2">
						<i class="fas fa-edit"></i>
						Edit
					</a>
					<x-form.delete :id="$item->uuid" :action="route('dashboard.master.item.destroy', $item->uuid)" :label="$item->name" text="Hapus" />
				</div>
			</div>
			<div class="card-body">
				<table class="table-striped table">
					<tr>
						<th>Kode</th>
						<td>{{ $item->code }}</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td>{{ $item->name }}</td>
					</tr>
					<tr>
						<th>Kategori</th>
						<td>{{ $item->category->name }}</td>
					</tr>
					<tr>
						<th>Kuantitas</th>
						<td>{{ $item->quantity }} {{ $item->unit->name }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endsection
