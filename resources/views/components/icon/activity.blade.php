@php
	$_PENDING = \App\Constants\StatusPeminjaman::PENDING;
	$_APPROVED = \App\Constants\StatusPeminjaman::APPROVED;
	$_REJECTED = \App\Constants\StatusPeminjaman::REJECTED;
	$_CANCELED = \App\Constants\StatusPeminjaman::CANCELED;
	$_RETURNED = \App\Constants\StatusPeminjaman::RETURNED;
	$options = [
	    (object) [
	        'type' => 'primary',
	        'value' => $_PENDING,
	        'icon' => 'fas fa-clock'
	    ],
	    (object) [
	        'type' => 'success',
	        'value' => $_APPROVED,
	        'icon' => 'fas fa-check'
	    ],
	    (object) [
	        'type' => 'danger',
	        'value' => $_REJECTED,
	        'icon' => 'fas fa-times'
	    ],
	    (object) [
	        'type' => 'danger',
	        'value' => $_CANCELED,
	        'icon' => 'fas fa-times'
	    ],
	    (object) [
	        'type' => 'secondary',
	        'value' => $_RETURNED,
	        'icon' => 'fas fa-undo'
	    ],
	];
@endphp

@foreach ($options as $option)
	@if ($value == $option->value)
		<div class="activity-icon {{ 'bg-' . $option->type }} {{ 'shadow-' . $option->type }} {{ $option->type == 'secondary' ? 'text-dark' : 'text-white' }}">
			<i class="{{ $option->icon }}"></i>
		</div>
	@endif
@endforeach
