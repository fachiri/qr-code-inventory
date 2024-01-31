@extends('layouts.public')
@section('title', 'Dasbor')
@section('content')
	<section class="section">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
					<div class="login-brand">
						Detail Barang
					</div>
					<div class="card card-primary">
						<div class="card-header">
							<h4>Detail {{ $item->name }}</h4>
						</div>
						<div class="card-body">
              <div class="d-flex justify-content-between">
                <span>Kode</span>
                <b>{{ $item->code }} {{ request('no') }}</b>
              </div>
              <div class="d-flex justify-content-between">
                <span>Nama</span>
                <b>{{ $item->name }}</b>
              </div>
              <div class="d-flex justify-content-between">
                <span>Kategori</span>
                <b>{{ $item->category->name }}</b>
              </div>
							<div class="text-center pt-4">
								<button type="button" class="btn btn-lg btn-round btn-primary">
									Peminjaman
								</button>
							</div>
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
