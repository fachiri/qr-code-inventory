<div class="modal fade" id="{{ $id }}">
	<div class="modal-dialog">
		<form action="{{ $action }}" method="{{ isset($method) && $method == 'GET' ? 'GET' : 'POST' }}" class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{{ $title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				@method($method ?? 'POST')
				{{ $slot }}
			</div>
			<div class="modal-footer bg-whitesmoke br">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
