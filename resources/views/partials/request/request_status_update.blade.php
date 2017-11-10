<form method="POST" action="{{ $post_route }}">
	{{ csrf_field() }}
	<input name="_method" type="hidden" value="PUT">

	
	<label class="pendente">
		<input type="radio" name="status" value="0"
			{{ $request->status == 0? 'checked' : '' }}>Pendente
	</label>

		<label class="indisponivel">
			<input type="radio" name="status" value="1"
				{{ $request->status == 1? 'checked' : '' }}>Rejeitado
	</label>

		<label class="disponivel">
			<input type="radio"  name="status" value="2"
				{{ $request->status == 2? 'checked' : '' }}>Aceito
		</label><br />

		<div class="btn-confirma">
			<input type="submit" class="btn btn-primary" value="Confirma">
		</div>
</form>
