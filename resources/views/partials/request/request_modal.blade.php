<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel"></h4>
</div>
<div class="modal-body">
	<a href="{{ route('requests.show', $request->id) }}">
		<h2 class="text-center">{{ $request->event }}</h2>
	</a>

	<div class="row">
		<label class="col-md-2 control-label">Data: </label>
		<div class="col-md-8">
			<p>{{ $request->dateC->format('d/m/Y') }}</p>
		</div>
	</div>

	<div class="row">
		<label class="col-md-2 control-label">Local: </label>
		<div class="col-md-8">
			<p>{{ $request->auditorium->name }}</p>
		</div>
	</div>

	<div class="row">
		<label class="col-md-2 control-label">Descrição: </label>
		<div class="col-md-8">
			<p>{{ $request->description }}</p>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
