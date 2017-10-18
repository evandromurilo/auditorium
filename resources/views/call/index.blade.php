@extends('layouts.app')

@section('title', 'Chamadas')

@section('content')
	<h1>Chamadas</h1>
	<a href="{{ route('calls.create') }}">
		Nova Chamada
	</a>
	<ul>
	@foreach ($calls as $call)
		<li><a href="{{ route('calls.show', $call->id) }}">
			{{ $call->title }}
		</a></li>
	@endforeach
	</ul>
@endsection
