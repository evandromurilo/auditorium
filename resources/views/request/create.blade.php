@extends('layouts.app')

@section('title', 'Novo Pedido')

@section('content')
	<h1>Agendar {{ $aud->name }}</h1>
	<p>Data: {{ $date->format('d/m/Y') }}</p>

	<form method="POST" action="{{ route('requests.store') }}">
		{{ csrf_field() }}
		<input type="hidden" name="date" value="{{ $date->toDateString() }}">
		<input type="hidden" name="auditorium_id" value="{{ $aud->id }}">
		<label>Período:</label>
		<select name="period">
			<option value="0">Manhã</option>
			<option value="1">Tarde</option>
			<option value="2">Noite</option>
		</select></br>

		<label>Evento: </label><input type="text" name="event"></br>
		<label>Descrição: </label><input type="text" name="description"></br>

		<input type="submit">
	</form>
@endsection
