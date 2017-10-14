@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')
	<h1>{{ $user->name }}</h1>
	<div style="width:150px; height:150px; background-color:{{ $user->color }};">
		<spam style="color:white; font-size:8em;">{{ $user->name[0] }}</spam>
	</div>

	<p>{{ $user->description }}</p>
	<p>{{ $user->email }}</p>
	<p>{{ $user->cel }}</p>
@endsection
