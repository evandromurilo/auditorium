@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')

	<link rel="stylesheet" href="{{ asset('css/style-user-show.css')}}">


	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<h1>{{ $user->name }}</h1>
				<div class="well" style="background-color:{{ $user->color }};">
						<p class="letra-perfil text-center">{{ $user->name[0] }}</p>
				</div>

				<p>{{ $user->description }}</p>
				<p>{{ $user->email }}</p>
				<p>{{ $user->cel }}</p>
				<p class="chat">Chat <i class="fa fa-comments-o" aria-hidden="true"></i></p>
			</div>

			<div class="col-md-8 col-lg-8">
				aaaaaaaaa
			</div>
		</div>
	</div>

@endsection
