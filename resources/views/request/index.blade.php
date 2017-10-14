@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')

	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css') }}">

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
							<h2 class="text-center"> {{ $request->auditorium->name }} </h2>
							<p><strong>Data:</strong> {{ $request->dateC->format('d/m/Y') }}</p>
							<p><strong>Período:</strong> {{ $request->periodF }}</p>
							<p><strong>Por:</strong> {{ $request->user->name }}</p>

							<form method="POST" action="{{ route('requests.update', $request->id) }}">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="PUT">

								<label>Status:</label><br>

								<label class="pendente">
									<input type="radio" name="status" value="0"
										{{ $request->status == 0? 'checked' : '' }}>Pendente
								</label>

									<label class="indisponivel">
										<input type="radio" name="status" value="1"
											{{ $request->status == 1? 'checked' : '' }}>Rejeitado
								</label>

									<label class="disponivel">
										<input type="radio"  name="status" value="2"
											{{ $request->status == 2? 'checked' : '' }}>Aceitar
									</label><br />

								<input type="submit" class="btn btn-primary" value="Confirma">
							</form>
						</div>
					</div>
				@endforeach
			</div>
		</div>
@endsection
