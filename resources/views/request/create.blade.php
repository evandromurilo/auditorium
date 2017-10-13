@extends('layouts.app')

@section('title', 'Novo Pedido')

@section('content')
	<h1>Agendar {{ $aud->name }}</h1>
	<p>Data: {{ $date->format('d/m/Y') }}</p>

	<form method="POST" action="{{ route('requests.store') }}">
		{{ csrf_field() }}
		<input type="hidden" name="date" value="{{ $date->toDateString() }}">
		<input type="hidden" name="auditorium_id" value="{{ $aud->id }}">
		<input type="hidden" name="from_time" value="00:00:00">
		<input type="hidden" name="until_time" value="23:59:59">

		<label>Evento: </label><input type="text" name="event"></br>
		<label>Descrição: </label><input type="text" name="description"></br>

		<input type="submit">
	</form>
@endsection
