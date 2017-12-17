@extends('layouts.app')

@section('title', 'Auditórios')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form-group" method="GET" action="{{ route('auditoria.index') }}">
					<div class="position-form">
						<a href="{{ route('auditoria.index', ['date' => $date->format('d/m/Y'),
							'previous' => 'true']) }}"><i class="fa fa-chevron-left arrow-left"
								aria-hidden="true"></i></a>

						<input
						 type="text"
						 id="date"
						 name="date"
						 class="text-center input-date"
						 autocomplete="off"
						 value="{{ $date->format('d/m/Y') }}">

						<a href="{{ route('auditoria.index', ['date' => $date->format('d/m/Y'),
							'next' => 'true']) }}"><i class="fa fa-chevron-right arrow-right"
								aria-hidden="true"></i></a>
					</div>

					<div class="btn-position day"><span id="weekday"></span></div>

					<div class="btn-position">
						<input
						style="color: #fff;"
						type="submit"
						class="btn btn-primary position-submit"
						value="Buscar Auditório">
					</div>
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

								<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Manhã:</span>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									@include('partials.status', ['code' => $statusOn->morning, 'period_code' => 0])
								</div>

								<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Tarde:</span>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									@include('partials.status', ['code' => $statusOn->afternoon, 'period_code' => 1])
								</div>

								<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Noite:</span>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									@include('partials.status', ['code' => $statusOn->night, 'period_code' => 2])
								</div>

								<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Capacidade: </span>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									{{ $aud->capacity }} pessoas.

								</div>
							</div>



						@if ($aud->accessible)

							<!--icons acessibilidade-->
							<div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
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
			@endforeach
		</div>
	</div>

	<footer class="container-fluid">
					<div class="container">
							<div class="row">
									<div class="col-md-4 col-lg-4 text-center evandro-footer">
											<strong>Dev</strong>Back-end: <a href="https://github.com/evandromurilo" targe="_brank">Evandro Murilo</a>
											<div class="icon-footer">
													 <i class="fa fa-github" aria-hidden="true"></i>
											</div>
									</div>

									<div class="col-md-4 col-lg-4 logo-footer">
											<img src="../img/logo.png" alt="ulbra"></img>
									</div>

									<div class="col-md-4 col-lg-4 text-center valdeir-footer">
											<strong>Dev</strong>Front-end: <a href="https://github.com/valdeircesconeto" targe="_brank">Valdeir Cesconeto</a>
											<div class="icon-footer">
													 <i class="fa fa-github" aria-hidden="true"></i>
											</div>
									</div>
							</div>
					</div>
			</footer>


@endsection

@section('sources')
	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css')}}">

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/date-helpers.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-scripts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-script-icons-auditorium-index.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-script-icons-auditorium-index.js') }}"></script>

	<script>
		function updateWeekDay() {
			var dateString = $('#date').val();
			var dataParts = dateString.split('/');
			var weekday = getWeekDay(new Date(dataParts[2], dataParts[1]-1, dataParts[0]));
			console.log(weekday);
			$('#weekday').text(weekday);
		}

		updateWeekDay();

		$("body").on('input', '#date', function() {
			if ($('#date').val().match(/^(\d{2})\/(\d{2})\/(\d{4})$/)) {
				updateWeekDay();
			}
		});
	</script>
@endsection
