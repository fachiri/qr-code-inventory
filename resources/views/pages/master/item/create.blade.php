@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        'Tambah Data' => null,
    ],
])
@section('title', 'Master Barang')
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Barang</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.item.store') }}" method="POST">
					@csrf
					<x-form.input type="date" name="date" label="Tanggal Masuk" placeholder="Tanggal Masuk Barang" />
					<x-form.select name="code" label="Kodefikasi" :options="$codefications->map(function ($codefication) {
					    return (object) ['label' => $codefication[0] . '.' . $codefication[1] . '.' . $codefication[2] . '.' . $codefication[3] . '.' . $codefication[4] . ' | ' . $codefication[6], 'value' => $codefication[0] . '.' . $codefication[1] . '.' . $codefication[2] . '.' . $codefication[3] . '.' . $codefication[4]];
					})" />
					<x-form.input name="name" label="Nama Barang" placeholder="Isi nama barang" />
					<x-form.select name="unit_id" label="Satuan" :options="$units->map(function ($unit) {
					    return (object) ['label' => $unit->name . ' (' . $unit->detail . ')', 'value' => $unit->id];
					})" />
					<x-form.select name="category_id" label="Kategori" :options="$categories->map(function ($category) {
					    return (object) ['label' => $category->name . ' (' . $category->detail . ')', 'value' => $category->id];
					})" />
					<x-form.input type="number" name="quantity" label="Kuantitas" placeholder="Isi Kuantitas" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
