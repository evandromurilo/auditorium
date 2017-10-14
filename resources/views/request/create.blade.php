@extends('layouts.app')

@section('title', 'Novo Pedido')

@section('content')

	<link rel="stylesheet" href="{{ asset('css/style-request-create.css')}}">

	<div class="container">
		<div class="row">
			<h1>Agendar {{ $aud->name }}</h1>
			<p>Data: {{ $date->format('d/m/Y') }}</p>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Descrição do Agendamento</div>
						<form method="POST" class="form-horizontal" action="{{ route('requests.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="date" value="{{ $date->toDateString() }}">
							<input type="hidden" name="auditorium_id" value="{{ $aud->id }}">

							<label>Período:</label>
							<select name="period">
								<option value="0" {{ $period == 0? 'selected':'' }}>Manhã</option>
								<option value="1" {{ $period == 1? 'selected':'' }}>Tarde</option>
								<option value="2" {{ $period == 2? 'selected':'' }}>Noite</option>
							</select></br>

							<div class="form-group space-top">
								<label class="col-md-2 control-label">Evento </label>
								<div class="col-md-9">
									<input type="text" name="event" class="form-control" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Descrição </label>
								<div class="col-md-9">
									<input type="text" name="description" class="form-control" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<input type="submit" class="btn btn-primary" value="Agendar">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
