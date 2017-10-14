@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
	<h1>Pedidos</h1>
	<form method="GET" action="{{ route('requests.index') }}">
		<select onchange="this.form.submit()" name="filter">
			<option value="pendent">Pendentes</option>
			<option value="all" {{ $filter == 'all'? 'selected':'' }}>Todos</option>
			<option value="resolved" {{ $filter == 'resolved'? 'selected':'' }}>Resolvidos</option>
			<option value="rejected" {{ $filter == 'rejected'? 'selected':'' }}>Rejeitados</option>
			<option value="accepted" {{ $filter == 'accepted'? 'selected':'' }}>Aceitos</option>
		</select>
	</form>
		
	@foreach ($requests as $request)
		<div>
			<h2> {{ $request->auditorium->name }} </h2>
			<p><strong>Data:</strong> {{ $request->dateC->format('d/m/Y') }}</p>
			<p><strong>Período:</strong> {{ $request->periodF }}</p>
			<p><strong>Por:</strong> {{ $request->user->name }}</p>

			<form method="POST" action="{{ route('requests.update', $request->id) }}">
				{{ csrf_field() }}
				<input name="_method" type="hidden" value="PUT">

				<label>Status:</label><br>
				<input type="radio" name="status" value="0"
					{{ $request->status == 0? 'checked' : '' }}>Pendente<br>

				<input type="radio" name="status" value="1"
					{{ $request->status == 1? 'checked' : '' }}>Rejeitado<br>

				<input type="radio" name="status" value="2"
					{{ $request->status == 2? 'checked' : '' }}>Aceito<br>

				<input type="submit">
			</form>
		</div>
	@endforeach
@endsection
