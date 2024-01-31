<div class="mb-3 {{ $class ?? '' }}">
  <label for="{{ $name }}" class="form-label">{{ $label }}</label>
  <textarea type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}">{{ $value ?? old($name) }}</textarea>
  @error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
