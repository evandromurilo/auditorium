@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
	<div class="container">
		<div class="row">
			<h1>Pedidos</h1>
				<!--<form method="GET" action="{{ route('requests.index') }}">
					<select onchange="this.form.submit()" name="filter">
						<option value="pendent">Pendentes</option>
						<option value="all" {{ $filter == 'all'? 'selected':'' }}>Todos</option>
						<option value="resolved" {{ $filter == 'resolved'? 'selected':'' }}>Resolvidos</option>
						<option value="rejected" {{ $filter == 'rejected'? 'selected':'' }}>Rejeitados</option>
						<option value="accepted" {{ $filter == 'accepted'? 'selected':'' }}>Aceitos</option>
					</select>-->
			<nav class="navbar navbar-default sub-menu" role="navigation">
					<div class="collapse navbar-collapse" id="navbar">
		          <ul class="nav navbar-nav">
		            <li><a href="{{-- route('ads.index', ['o' => 'desc']) --}}"
		              class=" {{ $filter == 'all' ? 'active' : ''}}">Todos</a></li>
		            <li><a href="{{-- route('ads.index', ['o' => 'asc']) --}}"
		              class=" {{ $filter == 'resolved' ? 'active' : '' }}">Resolvido</a></li>
		            <li><a href="{{-- route('ads.index', ['f' => 'm', 'o' => 'asc']) --}}"
		              class=" {{ $filter == 'rejected' ? 'active' : '' }}">Rejeitados</a></li>
		            <li><a href="{{-- route('ads.index', ['f' => 'm', 'o' => 'desc']) --}}"
		              class=" {{ $filter == 'accepted' ? 'active' : '' }}">Aceito</a></li>
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
								<input type="radio" name="status" value="0"
									{{ $request->status == 0? 'checked' : '' }}>Pendente<br>

								<input type="radio" name="status" value="1"
									{{ $request->status == 1? 'checked' : '' }}>Rejeitado<br>

								<input type="radio" name="status" value="2"
									{{ $request->status == 2? 'checked' : '' }}>Aceito<br>

								<input type="submit" class="btn btn-primary" value="Confirma">
							</form>
						</div>
					</div>
				@endforeach
			</div>
		</div>
@endsection
