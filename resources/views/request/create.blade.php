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
										{{ $errors->first('date') }}
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
											{{ $errors->first('event') }}
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
										{{ $errors->first('description') }}
									</span>
								@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Período</label>
								<div class="col-sm-5 col-md-5 col-lg-5">
									<select name="beginning" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @foreach ($periods as $p)
                      <option value="{{ $p->id }}" {{ $period == $p->id? 'selected':'' }}>{{ $p->name }}</option>
                    @endforeach
									</select>

                  <span>até</span>

									<select name="end" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @foreach ($periods as $p)
                      <option value="{{ $p->id }}" {{ $period == $p->id? 'selected':'' }}>{{ $p->name }}</option>
                    @endforeach
									</select>

								@if ($errors->has('period'))
									<span class="help-block">
										{{ $errors->first('period') }}
									</span>
								@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('claimant') ? ' has-error' : '' }}">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Requerente</label>
								<div class="col-sm-9 col-md-9 col-lg-9">
									<input type="text"
										name="claimant"
										class="form-control"
										autocomplete="off"
										value="{{ old('claimant') }}">


								@if ($errors->has('claimant'))
									<span class="help-block">
										{{ $errors->first('claimant') }}
									</span>
								@endif
								</div>
							</div>

              <div class="form-group">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Requisitos</label>
								<div class="checkbox-inline col-sm-9 col-md-9 col-lg-9">
									@foreach ($requirements as $requirement)
										<input type="checkbox" class="" name="requirement[]" value="{{ $requirement->name }}">
										{{ $requirement->name }}<br>
									</input>
								@endforeach
								</div>
              </div>

              <requirements></requirements>

							<div class="form-group">
								<div class="col-sm-2 col-md-2 col-lg-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
									<input type="submit" class="btn btn-primary" value="Agendar">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

@endsection
