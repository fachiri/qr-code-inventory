@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Pengguna' => route('dashboard.user.index'),
        $user->name => null,
    ],
])
@section('title', 'Detail Pengguna')
@section('content')
	<div class="section-body">
		<div class="card mb-4 shadow-lg text-dark">
			<div class="card-header d-flex justify-content-between">
				<h5>Informasi</h5>
				<div class="d-flex justify-content-end gap-2">
					<a href="{{ route('dashboard.user.edit', $user->uuid) }}" class="btn btn-warning btn-sm mr-2">
						<i class="fas fa-edit"></i>
						Edit
					</a>
					<x-form.delete :id="$user->uuid" :action="route('dashboard.user.destroy', $user->uuid)" :label="$user->name" text="Hapus" />
				</div>
			</div>
			<div class="card-body">
				<table class="table-striped table">
					<tr>
						<th colspan="2">
							<h6 class="mb-0">Personal</h6>
						</th>
					</tr>
					<tr>
						<th>Nama</th>
						<td>{{ $user->name }}</td>
					</tr>
					@if ($user->lecturer)
						<tr>
							<th>NIDN</th>
							<td>{{ $user->lecturer->nidn }}</td>
						</tr>
						<tr>
							<th>Jabatan</th>
							<td>{{ $user->lecturer->jabatan }}</td>
						</tr>
					@endif
					@if ($user->student)
						<tr>
							<th>NIM</th>
							<td>{{ $user->student->nim }}</td>
						</tr>
					@endif
					<tr>
						<th colspan="2">
							<h6 class="mb-0">Akun</h6>
						</th>
					</tr>
					<tr>
						<th>Username</th>
						<td>{{ $user->username }}</td>
					</tr>
					<tr>
						<th>Password</th>
						<td>****************</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $user->email ?? '-' }}</td>
					</tr>
					<tr>
						<th>Status</th>
						<td>
							<x-badge value="{{ $user->status }}" :options="[
							    (object) [
							        'type' => 'success',
							        'value' => App\Constants\StatusUser::ACTIVE,
							    ],
							    (object) [
							        'type' => 'danger',
							        'value' => App\Constants\StatusUser::INACTIVE,
							    ],
							]" />
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endsection
