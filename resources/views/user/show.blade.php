@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')

	<link rel="stylesheet" href="{{ asset('css/style-user-show.css')}}">
	<div class="container">
		<h1>{{ $user->name }}</h1>
		<div class="perfil-circle" style="background-color:{{ $user->color }};">
			<div class="letra-perfil">
				<spam>{{ $user->name[0] }}</spam>
			</div>
		</div>

		<p>{{ $user->description }}</p>
		<p>{{ $user->email }}</p>
		<p>{{ $user->cel }}</p>
	</div>

@endsection
