@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Pengguna' => route('dashboard.user.index'),
        $user->name => route('dashboard.user.show', $user->uuid),
        'Edit' => null,
    ],
])
@section('title', 'Edit Pengguna')
@section('content')
	<div class="section-body">
		<div class="card mb-4 shadow-sm">
			<div class="card-header d-flex justify-content-between">
				<h5>Personal</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.user.update', $user->uuid) }}" method="POST">
					@csrf
					@method('PATCH')
					<x-form.input name="name" label="Nama Lengkap" class="form-group" :value="$user->name" />
					@if ($user->lecturer)
						<x-form.input name="nidn" label="Nomor Induk Dosen Nasional" class="form-group" :value="$user->lecturer->nidn" />
						<x-form.select name="jabatan" label="Pilih Jabatan" class="form-group" :value="$user->lecturer->jabatan" :options="[
						    (object) [
						        'label' => App\Constants\JabatanDosen::KEPALA_LAB,
						        'value' => App\Constants\JabatanDosen::KEPALA_LAB,
						    ],
						    (object) [
						        'label' => App\Constants\JabatanDosen::DOSEN,
						        'value' => App\Constants\JabatanDosen::DOSEN,
						    ],
						]" />
					@endif
					@if ($user->student)
						<x-form.input name="nim" label="Nomor Induk Mahasiswa" class="form-group" :value="$user->student->nim" />
					@endif
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Perbarui</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card mb-4 shadow-sm">
			<div class="card-header d-flex justify-content-between">
				<h5>Akun</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.user.update.account', $user->uuid) }}" method="POST">
					@csrf
					@method('PATCH')
					<x-form.input name="username" label="Username" class="form-group" :value="$user->username" />
					<x-form.input type="email" name="email" label="Email" placeholder="Isi Email Aktif" class="form-group" :value="$user->email" />
					<x-form.select name="status" label="Pilih status" class="form-group" :value="$user->status" :options="[
					    (object) [
					        'label' => App\Constants\StatusUser::ACTIVE,
					        'value' => App\Constants\StatusUser::ACTIVE,
					    ],
					    (object) [
					        'label' => App\Constants\StatusUser::INACTIVE,
					        'value' => App\Constants\StatusUser::INACTIVE,
					    ],
					]" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Perbarui</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card mb-4 shadow-sm">
			<div class="card-header d-flex justify-content-between">
				<h5>Ganti Password</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('dashboard.user.update.password', $user->uuid) }}" method="POST">
					@csrf
					@method('PATCH')
					<x-form.input type="password" name="new_password" label="Password Baru" class="form-group" />
					<x-form.input type="password" name="repeat_password" label="Konfirmasi Password Baru" class="form-group" />
					<div class="pt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
