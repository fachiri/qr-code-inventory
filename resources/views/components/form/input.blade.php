<div class="mb-3 {{ $class ?? '' }}">
  <label for="{{ $name }}" class="form-label">{{ $label }}</label>
  <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? old($name) }}" autocomplete="{{ $autocomplete ?? '' }}" tabindex={{ $tabindex ?? '' }}>
  @error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
