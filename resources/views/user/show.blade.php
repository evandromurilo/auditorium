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

	<div>
		<h2>Histórico de Agendamentos</h2>
		@if ($requests->isEmpty())
			<p>Nenhum agendamento feito.</p>
		@else
			@foreach ($requests as $request)
				<p>{{ $request->auditorium->name }} ({{ $request->dateC->format('d/m/Y') }}) 
				@if ($request->status == 0)
					(pendente)
				@elseif ($request->status == 1)
					(rejeitado)
				@else
					(aceito)
				@endif
				</p>
			@endforeach
		@endif
	</div>

@endsection
