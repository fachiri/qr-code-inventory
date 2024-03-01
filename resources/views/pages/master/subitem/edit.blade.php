@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        $subitem->item->code => route('dashboard.master.item.show', $subitem->item->uuid),
        str_pad($subitem->number, 3, '0', STR_PAD_LEFT) => route('dashboard.master.subitem.show', $subitem->uuid),
        'Edit' => null,
    ],
])
@section('title', 'Edit ' . $subitem->item->name . ' - ' . str_pad($subitem->number, 3, '0', STR_PAD_LEFT))
@section('content')
	<div class="section-body">
		<div class="card shadow-lg text-dark">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Edit Barang</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.subitem.update', $subitem->uuid) }}" method="POST">
					@csrf
					@method('PUT')
					<x-form.input type="date" name="entry_date" label="Tanggal Masuk" placeholder="Tanggal Masuk Barang" :value="$subitem->entry_date" />
					<x-form.select name="is_pinjamable" label="Dapat Dipinjam" :value="$subitem->is_pinjamable" :options="[
					    (object) [
					        'label' => 'Ya',
					        'value' => 1,
					    ],
					    (object) [
					        'label' => 'Tidak',
					        'value' => 0,
					    ],
					]" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
