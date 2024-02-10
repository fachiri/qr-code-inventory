@foreach ($options as $option)
	@if ($value == $option->value)
		<span class="badge {{ 'badge-' . $option->type }}">{{ $value }}</span>
	@endif
@endforeach
