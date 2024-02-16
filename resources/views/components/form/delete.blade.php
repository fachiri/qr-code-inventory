<button class="btn btn-danger {{ $size ?? '' }} {{ $class ?? '' }}" data-confirm="{{ 'Konfirmasi Hapus|' . 'Anda akan menghapus data <b>' . $label . '</b>' }}" data-confirm-yes="deleteData('{{ $id }}');">
	<i class="fas fa-trash"></i>
	{{ $text ?? '' }}
</button>
<form action="{{ $action }}" method="POST" class="d-none" id="formDelete{{ $id }}">
	@csrf
	@method('DELETE')
</form>
@push('scripts')
	<script>
		const deleteData = (id) => {
			const form = document.querySelector(`#formDelete${id}`);
			form.submit();
		}
	</script>
@endpush
