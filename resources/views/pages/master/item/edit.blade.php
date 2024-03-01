@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        $item->code => route('dashboard.master.item.show', $item->uuid),
        'Edit' => null,
    ],
])
@section('title', 'Edit ' . $item->name)
@section('content')
	<div class="section-body">
		<div class="card mb-4 shadow-lg text-dark">
			<div class="card-header d-flex justify-content-between">
				<h5>Edit Barang</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.item.update', $item->uuid) }}" method="POST">
					@csrf
					@method('PATCH')
					<x-form.select name="code" label="Kodefikasi" :value="$item->code" :options="$codefications->map(function ($codefication) {
					    return (object) ['label' => $codefication[0] . '.' . $codefication[1] . '.' . $codefication[2] . '.' . $codefication[3] . '.' . $codefication[4] . ' | ' . $codefication[6], 'value' => $codefication[0] . '.' . $codefication[1] . '.' . $codefication[2] . '.' . $codefication[3] . '.' . $codefication[4]];
					})" />
					<x-form.input name="name" label="Nama Barang" placeholder="Isi nama barang" :value="$item->name" />
					<x-form.select name="unit_id" label="Satuan" :value="$item->unit_id" :options="$units->map(function ($unit) {
					    return (object) ['label' => $unit->name . ' (' . $unit->detail . ')', 'value' => $unit->id];
					})" />
					<x-form.select name="category_id" label="Kategori" :value="$item->category_id" :options="$categories->map(function ($category) {
					    return (object) ['label' => $category->name . ' (' . $category->detail . ')', 'value' => $category->id];
					})" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Perbarui</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
