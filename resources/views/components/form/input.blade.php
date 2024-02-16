<div class="{{ $class ?? '' }} mb-3">
	<label for="{{ $name }}" class="form-label">{{ $label }}</label>
	@if (isset($disabled))
		<input class="form-control" value="{{ $value }}" disabled />
	@else
		<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? old($name) }}" autocomplete="{{ $autocomplete ?? '' }}" tabindex={{ $tabindex ?? '' }}>
	@endif
	@error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
