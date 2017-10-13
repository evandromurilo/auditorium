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
					<input type="text" id="date" name="date" class="form-control text-center input-date" autocomplete="off" value="{{ $date->format('d/m/Y') }}"><br />
					<input type="submit" class="btn btn-primary position-submit" value="Solicitar Auditório">
				</form>
			</div>
		</div>
	</div>



	<div class="container">
		<div class="row">
			@foreach ($auditoria as $aud)
				<?php $status = $aud->statusOn($date); ?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="well well-hr">

					</div>
					<div class="well">
				<h2 class="text-center">{{ $aud->name }}</h2>

				@if ($status->code == 1)
					<p style="color:green;">{{ $status }}</p>
					<a href={{ route('requests.create', ['date' => $date->format('d/m/Y'),
																							 'id' => $aud->id]) }}>
					 Agendar
					</a>
				@elseif ($status->code == 0)
					<p style="color:orange;">{{ $status }}</p>
				@elseif ($status->code == 2)
					<p style="color:red;">{{ $status }}</p>
				@endif
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection
