@extends('layouts.dashboard', [
	'breadcrumbs' => [
		'Dashboard' => route('dashboard.index'),
		'Master' => null,
		'Unit' => null,
	],
])
@section('title', 'Dashboard')
@section('content')
		<div class="section-body">
			<div class="row">
				<div class="col-6">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-3 col-3">
							<div class="card shadow-lg text-dark card-statistic-1">
								<div class="card-icon bg-primary">
									<i class="far fa-user"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Total Pengguna</h4>
									</div>
									<div class="card-body">
										10
									</div>
								</div>
							</div>
						</div>	
						<div class="col-lg-6 col-md-6 col-sm-3 col-3">
							<div class="card shadow-lg text-dark card-statistic-1">
								<div class="card-icon bg-danger">
									<i class="fas fa-tags"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Jumlah Kategori</h4>
									</div>
									<div class="card-body">
										42
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-3 col-3">
							<div class="card shadow-lg text-dark card-statistic-1">
								<div class="card-icon bg-warning">
									<i class="fas fa-boxes"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Total Barang</h4>
									</div>
									<div class="card-body">
										1,201
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-3 col-3">
							<div class="card shadow-lg text-dark card-statistic-1">
								<div class="card-icon bg-success">
									<i class="fas fa-retweet"></i>
								</div>
								<div class="card-wrap">
									<div class="card-header">
										<h4>Peminjaman</h4>
									</div>
									<div class="card-body">
										47
									</div>
								</div>
							</div>
						</div>     
					</div>
				</div>
				<div class="col-6">
					<div class="pl-0 col-12">
						<div class="card shadow-lg">
							<div class="card-header">
							<h4>Riwayat Peminjam</h4>
							<div class="card-header-action">
								<a href="#" class="btn btn-primary">Lihat Semua</a>
							</div>
							</div>
							<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped mb-0">
								<thead>
									<tr>
									<th>Nama Barang</th>
									<th>Peminjam</th>
									</tr>
								</thead>
								<tbody>                         
									<tr>
									<td>
										Introduction Laravel 5
										<div class="table-links">
										in <a href="#">Web Development</a>
										<div class="bullet"></div>
										<a href="#">View</a>
										</div>
									</td>
									<td>
										<a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
									</td>
									</tr>
									<tr>
									<td>
										Laravel 5 Tutorial - Installation
										<div class="table-links">
										in <a href="#">Web Development</a>
										<div class="bullet"></div>
										<a href="#">View</a>
										</div>
									</td>
									<td>
										<a href="#" class="font-weight-600"><img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
									</td>
									</tr>
								</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
