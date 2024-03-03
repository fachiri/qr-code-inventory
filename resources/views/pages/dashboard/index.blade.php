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
						<div class="card text-dark card-statistic-1 shadow-lg">
							<div class="card-icon bg-primary">
								<i class="far fa-user"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Total Pengguna</h4>
								</div>
								<div class="card-body">
									{{ $userCount }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-3 col-3">
						<div class="card text-dark card-statistic-1 shadow-lg">
							<div class="card-icon bg-danger">
								<i class="fas fa-tags"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Jumlah Kategori</h4>
								</div>
								<div class="card-body">
									{{ $categoryCount }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-3 col-3">
						<div class="card text-dark card-statistic-1 shadow-lg">
							<div class="card-icon bg-warning">
								<i class="fas fa-boxes"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Total Barang</h4>
								</div>
								<div class="card-body">
									{{ $itemCount }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-3 col-3">
						<div class="card text-dark card-statistic-1 shadow-lg">
							<div class="card-icon bg-success">
								<i class="fas fa-retweet"></i>
							</div>
							<div class="card-wrap">
								<div class="card-header">
									<h4>Peminjaman</h4>
								</div>
								<div class="card-body">
									{{ $borrowCount }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-header text-dark shadow-lg">
								<h5>Kategori Barang</h5>
							</div>
							<div class="card-body text-dark shadow-lg">
								@foreach ($categories as $category)
									<div class="mb-4">
										@php
											$itemsCount = $category->items()->withCount('subitems')->get()->sum('subitems_count');
										@endphp
										<div class="text-small font-weight-bold text-muted float-right">{{ $itemsCount }}</div>
										<div class="font-weight-bold mb-1">{{ $category->name }}</div>
										<div class="progress" data-height="3">
											<div class="progress-bar" role="progressbar" data-width="{{ $itemsCount / $maxSubitemsCount * 100 }}%" aria-valuenow="{{ $itemsCount }}" aria-valuemin="0" aria-valuemax="{{ $maxSubitemsCount }}"></div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="col-12 pl-0">
					<div class="card text-dark shadow-lg">
						<div class="card-header">
							<h4>Riwayat Peminjam</h4>
							<div class="card-header-action">
								<a href="{{ route('dashboard.borrow.index') }}" class="btn btn-primary">Lihat Semua</a>
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table-striped mb-0 table">
									<thead>
										<tr>
											<th>Nama Barang</th>
											<th>Peminjam</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($latestBorrows as $borrow)
											<tr>
												<td>
													{{ $borrow->subitem->item->name }}
													<div class="table-links">
														Status: {{ $borrow->histories()->latest()->first()->status }}
													</div>
												</td>
												<td>
													<a href="{{ route('dashboard.user.show', $borrow->user->uuid) }}" class="font-weight-600">
														<img src="assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1"> 
														{{ $borrow->user->name }}
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">

			</div>
		</div>

	</div>
@endsection
