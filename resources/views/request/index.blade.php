@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')

	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style-request-index.css') }}">

	<div class="container">
		<div class="row">
			<h1>Pedidos</h1>
			<nav class="navbar navbar-default sub-menu" role="navigation">
					<div class="collapse navbar-collapse" id="navbar">
		          <ul class="nav navbar-nav">
		            <li><a href="{{ route('requests.index', ['filter' => 'pending']) }}"
		              class=" {{ $filter == 'pending' ? 'active' : ''}}">Pendentes</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'all']) }}"
		              class=" {{ $filter == 'all' ? 'active' : ''}}">Todos</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'resolved']) }}"
		              class=" {{ $filter == 'resolved' ? 'active' : '' }}">Resolvidos</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'rejected']) }}"
		              class=" {{ $filter == 'rejected' ? 'active' : '' }}">Rejeitados</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'accepted']) }}"
		              class=" {{ $filter == 'accepted' ? 'active' : '' }}">Aceitos</a></li>
		          </ul>
						</div>
					</div>
				</div>
		</nav>

	<div class="container">
		<div class="row">
				@foreach ($requests as $request)
					<div class="col-md-4">
						<div class="well">
							<h2 class="text-center">
								<a href="{{ route('requests.show', $request->id) }}">
									{{ $request->auditorium->name }}
								</a>
							</h2>
							<p><strong>Data:</strong> {{ $request->dateC->format('d/m/Y') }}</p>
							<p><strong>Período:</strong> {{ $request->periodF }}</p>
							<p class="text-capitalize"><strong>Solicitado por:</strong> 
								<a href="{{ route('users.show', $request->user_id) }}">
									{{ $request->user->name }}
								</a>
							</p>
							<?php $post_route = route('requests.update', ['id' => $request->id,
							'filter' => $filter, 'from' => 'index']) ?>
							<label>Status:</label><br>
							@include('partials.request.request_status_update')
						</div>
					</div>
				@endforeach
			</div>
		</div>
@endsection
