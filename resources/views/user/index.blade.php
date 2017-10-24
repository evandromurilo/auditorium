@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
	<h1>Usuários</h1>
	<ul>
	@foreach ($users as $user)
		<li>
			<a href="{{ route('users.show', $user->id) }}">
				{{ $user->name }}
			</a>
		</li>
	@endforeach
	</ul>
@endsection
