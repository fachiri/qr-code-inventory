<ul class="sidebar-menu">
	<li class="menu-header">Dashboard</li>
	<li>
		<a class="nav-link" href="blank.html">
			<i class="fas fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>
	<li class="menu-header">Master</li>
	<li>
		<a class="nav-link" href="{{ route('dashboard.master.unit.index') }}">
			<i class="fas fa-balance-scale"></i>
			<span>Unit</span>
		</a>
	</li>
  <li>
		<a class="nav-link" href="{{ route('dashboard.master.category.index') }}">
			<i class="fas fa-tags"></i>
			<span>Category</span>
		</a>
	</li>
  <li>
		<a class="nav-link" href="{{ route('dashboard.master.item.index') }}">
			<i class="fas fa-square"></i>
			<span>Item</span>
		</a>
	</li>
  <li>
		<a class="nav-link" href="blank.html">
			<i class="fas fa-th-large"></i>
			<span>Sub Item</span>
		</a>
	</li>
  <li class="menu-header">Transaction</li>
  <li>
		<a class="nav-link" href="blank.html">
			<i class="fas fa-sign-in-alt"></i>
			<span>Inbound Items</span>
		</a>
	</li>
  <li>
		<a class="nav-link" href="blank.html">
			<i class="fas fa-sign-out-alt"></i>
			<span>Outbound Items</span>
		</a>
	</li>
</ul>
