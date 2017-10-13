@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
	<h1>Pedidos</h1>
	@foreach ($requests as $request)
		<div>
			<h2> {{ $request->auditorium->name }} </h2>
			<p><strong>Data:</strong> {{ $request->dateC->format('d/m/Y') }}</p>
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
