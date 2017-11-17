@extends('layouts.app')

@section('title', $request->auditorium->name.' ('.$request->dateC->format('d/m/Y') .')')

@section('content')
	<link rel="stylesheet" href="{{ asset('css/style-request-show.css')}}">
	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style-request-status-update-show.css')}}">


		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading text-left">Pedido
							<span style="float:right;">{{ $request->auditorium->name }}</span>
						</div>
						<h2 class="text-center">{{ $request->event }}<br> ({{ $request->dateC->format('d/m/Y') }})</h2>
						<label>Local:</label><p> {{ $request->auditorium->name }}</p>
						<label>Descrição:</label><p> {{ $request->description }}</p>
						<label>Organizador:</label><p>
						<a href="{{ route('users.show', $request->user_id) }}">
							{{ $request->user->name }}
						</a></p>

						@can('resolve', \App\Request::class)
							<?php $route_args = ["id" => $request->id, "from" => "show"] ?>
							@include('partials.request.request_status_update_show')
						@else
							@if ($request->status == 0)
								<span class="pendente" style="background-color: #FF8C00;">Pendente</span>
							@elseif ($request->status == 1)
								<span class="indisponivel" style="background-color: red;">Rejeitado</span>
							@elseif ($request->status == 2)
								<span class="disponivel" style="background-color: green;">Aceito</span>
							@endif
						@endcan

					</div>
				</div>
			</div>
		</div>

@endsection
