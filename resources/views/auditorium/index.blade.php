@extends('layouts.app')

@section('title', 'Auditórios')

@section('content')

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="js/jquery.mask.js"></script>
	<script type="text/javascript" src="js/jquery-scripts.js"></script>

	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css')}}">


	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form-group position-form" method="GET" action="{{ route('auditoria.index') }}">
					<input type="text" id="date" name="date" class="form-control text-center input-date" autocomplete="off" placeholder="13/10/2017" value="{{ $date->format('d/m/Y') }}"><br />
					<input type="submit" class="btn btn-primary position-submit" value="Solicitar Auditório">
				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			@foreach ($auditoria as $aud)
				<?php $statusOn = $aud->statusOn($date); ?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<div class="progress">
							@include('partials.progress_bar', ['code' => $statusOn->morning,
							'period' => 'Manhã'])
							@include('partials.progress_bar', ['code' => $statusOn->afternoon,
							'period' => 'Tarde'])
							@include('partials.progress_bar', ['code' => $statusOn->night,
							'period' => 'Noite'])
						</div>
					<div class="well">
				<h2 class="text-center">{{ $aud->name }}</h2>
				<div class="row">

					<spam class="col-md-4 control-label">Manhã:</spam>
					<div class="col-md-8">
						@include('partials.status', ['code' => $statusOn->morning])
					</div>

					<spam class="col-md-4 control-label">Tarde:</spam>
					<div class="col-md-8">
						@include('partials.status', ['code' => $statusOn->afternoon])
					</div>

					<spam class="col-md-4 control-label">Noite:</spam>
					<div class="col-md-8">
						@include('partials.status', ['code' => $statusOn->night])
					</div>
				</div>

				<label>Capacidade: </label><p>{{ $aud->capacity }} pessoas.</p>
				<div class="row">
					@if ($aud->accessible)
						<spam class="col-md-4 control-label">Acessibilidade: </spam>
						<div class="col-md-8">
							<p>
									<i class="fa fa-wheelchair style-icons" aria-hidden="true"
										data-toggle="tooltip" data-placement="bottom" title="Cadeirante"></i>
									<i class="fa fa-blind style-icons" aria-hidden="true"
										data-toggle="tooltip" data-placement="bottom" title="Deficiente Visual"></i>
									<i class="fa fa-universal-access style-icons" aria-hidden="true"
									data-toggle="tooltip" data-placement="bottom" title="Acesso Universal"></i>
							</p>
						</div>

					@endif
				</div>

				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection
