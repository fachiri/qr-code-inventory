@php
	$_GOOD = App\Constants\SubItemCondition::GOOD;
	$_DAMAGED = App\Constants\SubItemCondition::DAMAGED;
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        'Detail ' . $item->name => route('dashboard.master.item.show', $item->uuid),
        'Tambah Sub Barang' => null,
    ],
])
@section('title', 'Tambah Sub Barang')
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Sub Barang ({{ $item->name }})</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.subitem.store', $item->uuid) }}" method="POST">
					@csrf
					<x-form.input name="name" label="Nama Sub Barang" placeholder="Isi Nama Sub Barang" />
					<x-form.select name="condition" label="Kondisi" :options="[
					    (object) [
					        'label' => $_GOOD,
					        'value' => $_GOOD
					    ],
					    (object) [
					        'label' => $_DAMAGED,
					        'value' => $_DAMAGED
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
