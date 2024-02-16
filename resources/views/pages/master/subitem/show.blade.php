@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        $subitem->item->code => route('dashboard.master.item.show', $subitem->item->uuid),
        str_pad($subitem->number, 3, '0', STR_PAD_LEFT) => null,
    ],
])
@section('title', 'Detail ' . $subitem->item->name . ' - ' . str_pad($subitem->number, 3, '0', STR_PAD_LEFT))
@section('content')
	<div class="section-body">
		<div class="card mb-4 shadow-sm">
			<div class="card-header d-flex justify-content-between">
				<h4>Detail Barang</h4>
				<div class="d-flex justify-content-end gap-2">
					<a href="{{ route('dashboard.master.subitem.print', $subitem->uuid) }}" class="btn btn-primary btn-sm mr-2 disabled">
						<i class="fas fa-print"></i>
						Cetak
					</a>
					<a href="{{ route('dashboard.master.subitem.edit', $subitem->uuid) }}" class="btn btn-warning btn-sm mr-2">
						<i class="fas fa-edit"></i>
						Edit
					</a>
					<x-form.delete :id="$subitem->uuid" :action="route('dashboard.master.subitem.destroy', $subitem->uuid)" :label="$subitem->item->name . ' dengan kode ' . $subitem->item->code . ' ' . str_pad($subitem->number, 3, '0', STR_PAD_LEFT)" text="Hapus" />
				</div>
			</div>
			<div class="card-body">
				<table class="table-striped table">
					<tr>
						<th>Tanggal Masuk</th>
						<td>{{ $subitem->entry_date }}</td>
					</tr>
					<tr>
						<th>Kode</th>
						<td>{{ $subitem->item->code }} {{ str_pad($subitem->number, 3, '0', STR_PAD_LEFT) }}</td>
					</tr>
					<tr>
						<th>Dapat Dipinjam</th>
						<td>
							<x-badge value="{{ $subitem->is_pinjamable }}" :options="[
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
					</tr>
				</table>
			</div>
		</div>
		<div class="card mb-4 shadow-sm">
			<div class="card-header d-flex justify-content-between">
				<h4>Komponen</h4>
			</div>
			<div class="card-body">
				<table class="table-striped table" id="datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Kondisi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($subitem->components as $componentItem)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $componentItem->name }}</td>
								<td>
									<x-badge value="{{ $componentItem->pivot->condition }}" :options="[
									    (object) [
									        'type' => 'success',
									        'value' => App\Constants\SubItemCondition::GOOD,
									    ],
									    (object) [
									        'type' => 'danger',
									        'value' => App\Constants\SubItemCondition::DAMAGED,
									    ],
									]" />
								</td>
								<td>
									<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKondisiKomponenModal{{ $componentItem->uuid }}">
										<i class="fas fa-edit"></i>
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@push('modals')
	@foreach ($subitem->components as $componentItem)
		<x-form.modal :action="route('dashboard.master.component.update.subitem', $componentItem->pivot->id)" method="PATCH" :id="'editKondisiKomponenModal' . $componentItem->uuid" :title="'Edit Kondisi ' . $componentItem->name">
			<x-form.select name="condition" label="Pilih kondisi" class="form-group" :value="$componentItem->pivot->condition" :options="[
			    (object) [
			        'label' => App\Constants\SubItemCondition::GOOD,
			        'value' => App\Constants\SubItemCondition::GOOD,
			    ],
			    (object) [
			        'label' => App\Constants\SubItemCondition::DAMAGED,
			        'value' => App\Constants\SubItemCondition::DAMAGED,
			    ],
			]" />
		</x-form.modal>
	@endforeach
@endpush
