@php
	$_GOOD = App\Constants\SubItemCondition::GOOD;
	$_DAMAGED = App\Constants\SubItemCondition::DAMAGED;
@endphp
@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Barang' => route('dashboard.master.item.index'),
        'Detail ' . $item->name => route('dashboard.master.item.show', $item->uuid),
        'Edit ' . $subItem->name => null
    ],
])
@section('title', 'Edit Sub Barang | ' . $subItem->name)
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Edit {{ $subItem->name }}</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.subitem.update', $subItem->uuid) }}" method="POST">
					@csrf
					@method('PUT')
					<x-form.input name="name" label="Nama Sub Barang" placeholder="Isi Nama Sub Barang" :value="$subItem->name" />
					<x-form.select name="condition" label="Kondisi" :value="$subItem->condition" :options="[
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
