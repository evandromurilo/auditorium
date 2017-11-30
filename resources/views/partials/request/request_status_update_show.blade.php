<link rel="stylesheet" href="{{ asset('css/style-request-status-update-show.css')}}">
@if ($request->status == 0)

	<div class="col-xs-12 col-sm-12 col-md-12 center-block">
			<a class="btn btn-aceita b-aceita" style="color: #fff; text-decoration: none;" href="{{ route('requests.accept', $route_args) }}">
			Aceitar
			</a>
			<a class="btn btn-rejeitado b-rejeitado" style="color: #fff; text-decoration: none;"  href="{{ route('requests.negate', $route_args) }}">
			Rejeitar
			</a>
	</div>

@elseif ($request->status == 1)

	<div class="col-xs-12 col-sm-12 col-md-12 center-block">
			<a class="btn btn-aceita b-aceita" style="color: #fff; text-decoration: none;" href="{{ route('requests.accept', $route_args) }}">
				Aceitar
			</a>
			<a class="btn btn-pendurado b-pendurado" style="color: #fff; text-decoration: none;" href="{{ route('requests.pending', $route_args) }}">
				Pendurar
			</a>
	 </div>

@elseif ($request->status == 2)

	<div class="col-xs-12 col-sm-12 col-md-12 center-block">
			<a class="btn btn-pendurado b-pendurado" style="color: #fff; text-decoration: none;" href="{{ route('requests.pending', $route_args) }}">
				Pendurar
			</a>
	 		<a  class="btn btn-rejeitado b-rejeitado" style="color: #fff; text-decoration: none;" href="{{ route('requests.negate', $route_args) }}">
	 			Rejeitar
			</a>
	</div>

@endif
