@extends('layouts.app')

@section('title', $request->auditorium->name.' ('.$request->dateC->format('d/m/Y') .')')

@section('content')
	<link rel="stylesheet" href="{{ asset('css/style-request-show.css')}}">

		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="well">
						<h1 class="text-center">{{ $request->event }} ({{ $request->dateC->format('d/m/Y') }})</h2>
						<label>Local:</label><p> {{ $request->auditorium->name }}</p>
						<label>Descrição:</label><p> {{ $request->description }}</p>
						<label>Organizador:</label><p> {{ $request->user->name }}</p>
						<label>Status:</label><p class="status">
						@if ($request->status == 0)
							<span class="pendente" style="background-color: #FF8C00;">Pendente</span>
						@elseif ($request->status == 1)
							<span class="indisponivel" style="background-color: red;">Rejeitado</span>
						@elseif ($request->status == 2)
							<span class="disponivel" style="background-color: green;">Aceito</span>
						@endif
						</p>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
@endsection
