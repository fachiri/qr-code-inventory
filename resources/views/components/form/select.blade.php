@push('styles')
	<link rel="stylesheet" href="{{ asset('modules/select2/select2.min.css') }}">
@endpush
<div class="{{ $class ?? '' }} mb-3">
	<label for="{{ $name }}" class="form-label">{{ $label }}</label>
	<select name="{{ $name }}" id="{{ $name }}" class="{{ 'select2-' . $name }} form-control select2 @error($name) is-invalid @enderror">
		@foreach ($options as $option)
			<option value="{{ $option->value }}" {{ ($value ?? old($name)) == $option->value ? 'selected' : '' }}>{{ $option->label }}</option>
		@endforeach
	</select>
	@error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
@push('scripts')
	<script src="{{ asset('modules/select2/select2.full.min.js') }}"></script>
	{{-- <script>
		const name = @json($name);
		const label = @json($label);
    const selector = ".select2-" + name;

		$(selector).select2({
			placeholder: 'Pilih ',
			allowClear: true
		});
	</script> --}}
@endpush
