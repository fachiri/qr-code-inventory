@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        $item->code => null,
    ],
])
@section('title', 'Detail ' . $item->name)
@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('modules/datatables/select.bootstrap4.min.css') }}">
@endpush
@section('content')
	<div class="section-body text-dark">
		<div class="card mb-4 border shadow-lg ">
			<div class="card-header d-flex justify-content-between">
				<h4>Detail Barang</h4>
				<div class="d-flex justify-content-end gap-2">
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
						<td>{{ $item->subitems->count() }} {{ $item->unit->name }}</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="card mb-4 border shadow-lg">
			<div class="card-header d-flex justify-content-between">
				<h4>Daftar {{ $item->name }}</h4>
				<div class="d-flex justify-content-end gap-2">
					<button class="btn btn-primary mr-2" data-toggle="modal" data-target="#tambahBarangModal">
						<i class="fas fa-plus"></i>
						Tambah Barang
					</button>
				</div>
			</div>
			<div class="card-body">
				<table class="table-striped table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Kode</th>
							<th>Dapat Dipinjam</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($item->subitems as $itemm)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $item->code }} {{ str_pad($itemm->number, 3, '0', STR_PAD_LEFT) }}</td>
								<td>
									<x-badge value="{{ $itemm->is_pinjamable }}" :options="[
									    (object) [
									        'type' => 'success',
									        'value' => 1,
									        'text' => 'Ya',
									    ],
									    (object) [
									        'type' => 'danger',
									        'value' => 0,
									        'text' => 'Tidak',
									    ],
									]" />
								</td>
								<td>
									<a href="{{ route('dashboard.master.subitem.show', $itemm->uuid) }}" class="btn btn-primary btn-sm">
										<i class="fas fa-list"></i>
									</a>
									<a href="{{ route('dashboard.master.subitem.edit', $itemm->uuid) }}" class="btn btn-warning btn-sm">
										<i class="fas fa-edit"></i>
									</a>
									<x-form.delete :id="$itemm->uuid" :action="route('dashboard.master.subitem.destroy', $itemm->uuid)" :label="$item->name . ' dengan kode ' . $item->code . ' ' . str_pad($itemm->number, 3, '0', STR_PAD_LEFT)" size="btn-sm" />
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-8">
				<div class="card mb-4 border shadow-lg" id="component">
					<div class="card-header d-flex justify-content-between">
						<h4>Komponen {{ $item->name }}</h4>
					</div>
					<div class="card-body">
						<table class="table-striped table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($item->components as $componentItem)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $componentItem->name }}</td>
										<td>
											<!-- <a href="{{ route('dashboard.master.component.show', $componentItem->uuid) }}" class="btn btn-primary btn-sm">
												<i class="fas fa-list"></i>
											</a> -->
											<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKomponenModal{{ $componentItem->uuid }}">
												<i class="fas fa-edit"></i>
											</button>
											<x-form.delete :id="$componentItem->uuid" :action="route('dashboard.master.component.destroy', $componentItem->uuid)" :label="'Komponen ' . $componentItem->name" size="btn-sm" />
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card mb-4 border shadow-lg">
					<div class="card-header d-flex justify-content-between">
						<h4>Tambah Komponen</h4>
					</div>
					<div class="card-body">
						<form action="{{ route('dashboard.master.component.store') }}" method="POST">
							@csrf
							<input type="hidden" name="item_id" value="{{ $item->id }}">
							<x-form.input name="name" label="Nama Komponen" placeholder="Isi Nama Komponen" />
							<div class="pt-2">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('modals')
	<x-form.modal :action="route('dashboard.master.subitem.store')" id="tambahBarangModal" title="Tambah {{ $item->name }}">
		<input type="hidden" name="item_id" value="{{ $item->id }}">
		<x-form.input type="date" name="entry_date" label="Tanggal Masuk" placeholder="Tanggal Masuk Barang" :value="date('Y-m-d')" />
		<x-form.input type="number" name="quantity" label="Kuantitas" placeholder="Isi Kuantitas" value="1" />
	</x-form.modal>
	@foreach ($item->components as $componentItem)
		<x-form.modal :action="route('dashboard.master.component.update', $componentItem->uuid)" method="PATCH" :id="'editKomponenModal' . $componentItem->uuid" title="Edit Komponen">
			<x-form.input name="name" label="Nama Komponen" placeholder="Isi Nama Komponen" :value="$componentItem->name" />
		</x-form.modal>
	@endforeach
@endpush
@push('scripts')
	<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/dataTables.select.min.js') }}"></script>
	<script src="{{ asset('modules/datatables/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/datatable.js') }}"></script>
@endpush
