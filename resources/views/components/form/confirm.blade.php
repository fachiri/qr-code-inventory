<button class="{{ $class ?? '' }}" data-confirm="{{ 'Konfirmasi|' . $label }}" data-confirm-yes="confirmData('{{ $id }}');">
	{{ $slot }}
</button>
<form action="{{ $action }}" method="{{ $method == 'GET' ? 'GET' : 'POST' }}" class="d-none" id="formConfirm{{ $id }}">
	@csrf
	@method($method)
</form>
@push('scripts')
	<script>
		const confirmData = (id) => {
			const form = document.querySelector(`#formConfirm${id}`);
			form.submit();
		}
	</script>
@endpush
