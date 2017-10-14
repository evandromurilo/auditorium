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
						  <div class="progress-bar progress-bar-success"  style="width: 33%">Manhã
						    <span class="sr-only">35% Complete (success)</span>
						  </div>
						  <div class="progress-bar progress-bar-warning" style="width: 33%">tarde
						    <span class="sr-only">20% Complete (warning)</span>
						  </div>
						  <div class="progress-bar progress-bar-danger" style="width: 33%">Noite
						    <span class="sr-only">10% Complete (danger)</span>
						  </div>
						</div>
					<div class="well">
				<h2 class="text-center">{{ $aud->name }}</h2>

				<spam>Manhã:</spam>
				@include('partials.status', ['code' => $statusOn->morning])

				<spam>Tarde:</spam>
				@include('partials.status', ['code' => $statusOn->afternoon])

				<spam>Noite:</spam>
				@include('partials.status', ['code' => $statusOn->night])

				<label>Capacidade: </label><p>{{ $aud->capacity }} pessoas.</p>
				@if ($aud->accessible)
					<label>Acessibilidade: </label><p>Este auditório preenche requisitos de acessibilidade.</p>
				@endif

				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection
