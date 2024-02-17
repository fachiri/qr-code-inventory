<button class="btn {{ $class ?? 'btn-primary' }}" data-confirm="{{ 'Konfirmasi|' . $label }}" data-confirm-yes="confirmData('{{ $id }}');">
	{{ $slot }}
</button>
<form action="{{ $action }}" method="{{ $method ?? 'POST' }}" class="d-none" id="formConfirm{{ $id }}">
	@csrf
	@method($method ?? 'POST')
</form>
@push('scripts')
	<script>
		const confirmData = (id) => {
			const form = document.querySelector(`#formConfirm${id}`);
			form.submit();
		}
	</script>
@endpush
