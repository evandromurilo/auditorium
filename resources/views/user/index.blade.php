@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
	<div class="container">
		<div class="row">
			<h1 class="text-left">Usuários</h1>
		</div>
	</div>
	<div class="container">
		<div class="">
			<div class="">

			</div>
		</div>
		@foreach ($users as $user)

				<a style="color: {{ $user->color }};" href="{{ route('users.show', $user->id) }}">
					{{ $user->name }}
				</a>

		@endforeach

	</div>

@endsection

@section('sources')

<link rel="stylesheet" href="{{ asset('css/style-user-index.css')}}">

@endsection
