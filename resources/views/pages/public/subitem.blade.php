@extends('layouts.public')
@section('title', 'Dasbor')
@section('content')
	<section class="section">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
					<x-main.alerts />
					<div class="login-brand">
						@if (isset($subitem))
							Detail Barang
						@else
							Not Found
						@endif
					</div>
					<div class="card card-primary">
						@if (isset($subitem))
							<div class="card-header">
								<h4>{{ $subitem->item->name }}</h4>
							</div>
						@endif
						<div class="card-body">
							@if (isset($subitem))
								<div class="d-flex justify-content-between mb-2">
									<span>Kode</span>
									<b>{{ $subitem->item->code }} {{ str_pad($subitem->number, 3, '0', STR_PAD_LEFT) }}</b>
								</div>
								<div class="d-flex justify-content-between mb-2">
									<span>Nama</span>
									<b>{{ $subitem->item->name }}</b>
								</div>
								<div class="d-flex justify-content-between mb-2">
									<span>Kategori</span>
									<b>{{ $subitem->item->category->name }}</b>
								</div>
								<div class="pt-4 text-center">
									@auth
										<a href="{{ route('dashboard.index') }}" class="btn btn-lg btn-round btn-outline-primary mr-3">
											<i class="fas fa-home"></i>
										</a>
									@endauth
									<button type="button" class="btn btn-lg btn-round btn-primary" data-toggle="modal" data-target="#peminjamanModal">
										Peminjaman
									</button>
								</div>
							@else
								<div class="mb-2 text-center">
									@if (isset($subitem))
										<b>{{ $subitem->item->name }}</b>
										dengan kode
										<b>{{ $subitem->item->code }} {{ $subitem->number }}</b>
										tidak ditemukan.
									@else
										Barang tidak ditemukan.
									@endif
								</div>
								<div class="pt-4 text-center">
									<a href="{{ route('dashboard.index') }}" class="btn btn-lg btn-round btn-primary">
										Dashboard
									</a>
								</div>
							@endif
						</div>
					</div>
					<div class="simple-footer">
						Copyright &copy; Lab Informatika UNG 2024
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('modals')
	@if (isset($subitem))
		<x-form.modal :action="route('dashboard.subitem.borrow', $subitem->uuid)" id="peminjamanModal" title="Peminjaman">
			<input type="hidden" name="from" value="{{ urlencode(url()->current()) }}">
			<x-form.textarea name="desc" label="Tujuan Peminjaman" placeholder="Isi tujuan peminjaman" />
		</x-form.modal>
	@endif
@endpush
