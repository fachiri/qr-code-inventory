@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Master Kategori' => route('dashboard.master.category.index'),
        'Tambah Data' => null,
    ],
])
@section('title', 'Master Kategori')
@section('content')
	<div class="section-body">
		<div class="card shadow-lg text-dark">
			<div class="card-header d-flex justify-content-between">
				<h4>Form Kategori</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.master.category.store') }}" method="POST">
					@csrf
					<x-form.input name="name" label="Nama Kategori" placeholder="Isi nama kategori" />
					<x-form.textarea name="detail" label="Detail" placeholder="Isi detail kategori" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
