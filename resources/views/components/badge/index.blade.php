@foreach ($options as $option)
	@if ($value == $option->value)
		<span class="badge {{ 'badge-' . $option->type }}">{{ $option->text ?? $value }}</span>
	@endif
@endforeach
