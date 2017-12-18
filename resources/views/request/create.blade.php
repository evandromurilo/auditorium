@extends('layouts.app')

@section('title', 'Novo Pedido')

@section('content')
	<link rel="stylesheet" href="{{ asset('css/style-request-create.css')}}">

	<div class="container">
		<div class="row">
			<h1 class="text-center title-agenda">Agendar {{ $aud->name }}</h1>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Descrição do Agendamento
						 <span class="date-top">Data: {{ $date->format('d/m/Y') }} </span>
					</div>
						<form method="POST" class="form-horizontal" action="{{ route('requests.store') }}">
							{{ csrf_field() }}
							<input type="hidden" name="date" value="{{ $date->toDateString() }}">
							<input type="hidden" name="auditorium_id" value="{{ $aud->id }}">

							@if ($errors->has('date'))
								<div class="text-center has-error">
									<span class="text-center has-error help-block">
										<strong>{{ $errors->first('date') }}</strong>
									</span>
								</div>
							@endif

							<div class="form-group{{ $errors->has('event') ? ' has-error' : '' }} space-top">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Evento</label>
								<div class="col-sm-9 col-md-9 col-lg-9">
									<input
										type="text"
										name="event"
										class="form-control"
										autocomplete="off"
										value="{{ old('event') }}">


								@if ($errors->has('event'))
									<span class="help-block">
											<strong>{{ $errors->first('event') }}</strong>
									</span>
								@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Descrição</label>
								<div class="col-sm-9 col-md-9 col-lg-9">
									<input type="text"
										name="description"
										class="form-control"
										autocomplete="off"
										value="{{ old('description') }}">


								@if ($errors->has('description'))
									<span class="help-block">
										<strong>{{ $errors->first('description') }}</strong>
									</span>
								@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Período</label>
								<div class="col-sm-5 col-md-5 col-lg-5">
									<select name="period" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<option value="0" {{ $period == 0? 'selected':'' }}>Manhã</option>
										<option value="1" {{ $period == 1? 'selected':'' }}>Manhã 2</option>
										<option value="2" {{ $period == 2? 'selected':'' }}>Tarde</option>
										<option value="3" {{ $period == 3? 'selected':'' }}>Tarde 2</option>
										<option value="4" {{ $period == 4? 'selected':'' }}>Intermediário</option>
										<option value="5" {{ $period == 5? 'selected':'' }}>Noite</option>
										<option value="6" {{ $period == 6? 'selected':'' }}>Noite 2</option>
									</select>

								@if ($errors->has('period'))
									<span class="help-block">
										<strong>{{ $errors->first('period') }}</strong>
									</span>
								@endif
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

@endsection
