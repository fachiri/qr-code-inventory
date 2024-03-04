<ul class="sidebar-menu ">
	<li class="menu-header">Dashboard</li>
	<li>
		<a class="nav-link" href="{{ route('dashboard.index') }}">
			<i class="fas fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
		<a class="nav-link" href="{{ route('dashboard.user.index') }}">
			<i class="fas fa-users"></i>
			<span>Pengguna</span>
		</a>
	</li>
	<li class="menu-header">Master</li>
	<li>
		<a class="nav-link" href="{{ route('dashboard.master.unit.index') }}">
			<i class="fas fa-balance-scale"></i>
			<span>Satuan</span>
		</a>
	</li>
	<li>
		<a class="nav-link" href="{{ route('dashboard.master.category.index') }}">
			<i class="fas fa-tags"></i>
			<span>Kategori</span>
		</a>
	</li>
	<li>
		<a class="nav-link" href="{{ route('dashboard.master.item.index') }}">
			<i class="fas fa-boxes"></i>
			<span>Barang</span>
		</a>
	</li>
	<li class="menu-header">Inventory</li>
	<li>
		<a class="nav-link" href="{{ route('dashboard.borrow.index') }}">
			<i class="fas fa-sign-in-alt"></i>
			<span>Peminjaman</span>
		</a>
	</li>
	{{-- <li>
		<a class="nav-link" href="blank.html">
			<i class="fas fa-sign-in-alt"></i>
			<span>Riwayat</span>
		</a>
	</li> --}}
</ul>
