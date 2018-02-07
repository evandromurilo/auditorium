@extends('layouts.app')

@section('title', 'Auditórios')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form-group" method="GET" action="{{ route('home') }}">
					<div class="position-form">
						<a href="{{ route('home', ['date' => $date->format('d/m/Y'),
							'previous' => 'true']) }}"><i class="fa fa-chevron-left arrow-left"
								aria-hidden="true"></i></a>

						<input
						 type="text"
						 id="date"
						 name="date"
						 class="text-center input-date"
						 autocomplete="off"
						 value="{{ $date->format('d/m/Y') }}">

						<a href="{{ route('home', ['date' => $date->format('d/m/Y'),
							'next' => 'true']) }}"><i class="fa fa-chevron-right arrow-right"
								aria-hidden="true"></i></a>
					</div>

					<div class="btn-position day">
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span id="weekday"></span>
            <p id="canrequest">{{ $canRequest }}</p>				
					</div>


					<div class="btn-position">
						<input
						style="color: #fff;"
						type="submit"
						class="btn btn-primary position-submit"
						value="Buscar Auditório">
					</div>
				</form>
			</div>
      <!-- <button type="button" id="collapse-all">+</button> -->
		</div>

    @foreach($blockedDates as $blockedDate)
      @if (!empty($blockedDate))
        <p class="text-center text-information"><i class="fa fa-exclamation-triangle"></i> {{ $blockedDate->motive }}</p>
      @endif
    @endforeach
	</div>

		<div class="container">
			<div class="row">
				@foreach ($auditoria as $aud)
				<div class="col-md-4 col-lg-4">
					<div class="well well-principal">
						<div class="row">
							<span class="col-md-10 col-lg-10 text-center aud-name"> {{ $aud->name}} </span>
							<a id="down" class="col-md-2 col-lg-2 icone-down" role="button" data-toggle="collapse"
							 href="#collapse{{ $aud->id }}" aria-expanded="false" aria-controls="collapseExample">
							 <i class="fa fa-caret-down" aria-hidden="true"></i>
							 </a>
						</div>
					</div>
					<div class="progress">
            @foreach ($periods as $period)
              @include('partials.progress_bar')
            @endforeach
					</div>

					<div class="row status-periodo">
						<div class="col-md-3 col-lg-3">
							<p class="text-center">Manhã</p>
						</div>
						<div class="col-md-6 col-lg-6">
							<p class="text-center">Tarde</p>
						</div>
						<div class="col-md-3 col-lg-3">
							<p class="text-center">Noite</p>
						</div>
					</div>

						<div class="espaco">

						</div>

					<div class="collapse collapse-auditorium" id="collapse{{$aud->id}}">
  					<div class="well well-collapse">

              @foreach ($periods as $period)
                @include('partials.auditorium.event_row')
              @endforeach

								<div class="row capacidade">
									<span class="col-xs-4 col-sm-4 col-md-3 col-lg-3 control-label">Capacidade:</span>
									<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">
										{{ $aud->capacity }} pessoas.
									</div>
								</div>

								@if ($aud->accessible)


									<div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
										<p class="accessible">
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
	<link rel="stylesheet" href="{{ asset('css/style-auditorium-2-0.css')}}">

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
	<script type="text/javascript" src="{{ asset('js/script-auditorium-2.0.js')}}"></script>

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
  
  <script>
    $(document).ready(function() {
      $("#collapse-all").on('click', function(e) {
        e.preventDefault();

        $(".collapse-auditorium").collapse('toggle');
      });
    });
  </script>
@endsection
