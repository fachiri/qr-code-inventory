@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Satuan' => route('dashboard.master.unit.index'),
        'Tambah Data' => null,
    ],
])
@section('title', 'Tambah Satuan')
@section('content')
	<div class="section-body">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Satuan</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.unit.store') }}" method="POST">
					@csrf
					<x-form.input name="name" label="Nama Satuan" placeholder="Isi nama satuan" />
					<x-form.textarea name="detail" label="Detail" placeholder="Isi detail satuan" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
