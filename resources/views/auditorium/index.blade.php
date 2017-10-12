@extends('layouts.app')

@section('title', 'Auditórios')

@section('content')
	<h1>Auditórios</h1>
	<form method="GET" action="{{ route('auditoria.index') }}">
		<input type="text" name="date" value="{{ $date->toDateString() }}">
		<input type="submit">
	</form>
	<p>{{ $date }}</p>
	
	@foreach ($auditoria as $aud)
		<h2>{{ $aud->name }}</h2>
		<p>{{ $aud->statusOn($date) }}</p>

		@if ($aud->statusOn($date)->status == 1)
			<a href={{ route('requests.create', ['date' => $date->toDateString(),
																					 'id' => $aud->id]) }}>
			 Agendar
			</a>
		@endif
	@endforeach
@endsection
