<button class="btn btn-success mr-2" id="{{ $idButton }}">
	<i class="fas fa-filter"></i>
	Filter
</button>
<div class="modal-part" id="{{ $idContent }}">
	{{ $slot }}
</div>
@push('scripts')
	<script>
		const idButton = @json($idButton);
		const idContent = @json($idContent);

		$(`#${idButton}`).fireModal({
			title: 'Login',
			body: $(`#${idContent}`),
			footerClass: 'bg-whitesmoke',
		});
	</script>
@endpush
