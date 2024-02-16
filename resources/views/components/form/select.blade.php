@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/select2/select2.min.css') }}">
@endpush
<div class="{{ $class ?? '' }} mb-3">
	<label for="{{ $name }}" class="form-label w-100">{{ $label }}</label>
	@if (isset($disabled))
		<select class="form-control select2" disabled>
			@foreach ($options as $option)
				<option value="{{ $option->value }}" {{ ($value ?? old($name)) == $option->value ? 'selected' : '' }}>{{ $option->label }}</option>
			@endforeach
		</select>
	@else
		<select name="{{ $name }}" id="{{ $name }}" class="{{ 'select2-' . $name }} form-control select2 @error($name) is-invalid @enderror" tabindex={{ $tabindex ?? '' }}>
			@foreach ($options as $option)
				<option value="{{ $option->value }}" {{ ($value ?? old($name)) == $option->value ? 'selected' : '' }}>{{ $option->label }}</option>
			@endforeach
		</select>
	@endif
	@error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
@push('scripts')
	<script src="{{ asset('modules/select2/select2.full.min.js') }}"></script>
@endpush
