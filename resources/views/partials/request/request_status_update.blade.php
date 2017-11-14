<link rel="stylesheet" href="{{ asset('css/style-request-status-update.css')}}">
@if ($request->status == 0)
	<div class="col-xs-12 col-sm-12 col-md-12 center-block">
		<button  class="btn btn-aceita aceita b-aceita">
			<a style="color: #fff; text-decoration: none;" href="{{ route('requests.accept', $route_args) }}">
			Aceitar</a>
		</button>

		<button  class="btn btn-rejeitado rejeitado b-rejeitado">
			<a style="color: #fff; text-decoration: none;"  href="{{ route('requests.negate', $route_args) }}">
			Rejeitar</a>
		</button>
	</div>
@elseif ($request->status == 1)

	<div class="col-xs-12 col-sm-12 col-md-12 center-block">
		<button class="btn btn-aceita aceita b-aceita">
			<a style="color: #fff; text-decoration: none;" href="{{ route('requests.accept', $route_args) }}">
				Aceitar</a>
		</button>

		<button class="btn btn-pendurado pendurado b-pendurado">
			<a style="color: #fff; text-decoration: none;" href="{{ route('requests.pending', $route_args) }}">
				Pendurar</a>
		 </button>
	 </div>

@elseif ($request->status == 2)

	<div class="col-xs-12 col-sm-12 col-md-12 center-block">
		<button class="btn btn-pendurado pendurado b-pendurado">
			<a style="color: #fff; text-decoration: none;" href="{{ route('requests.pending', $route_args) }}">
				Pendurar</a>
		 </button>

		 <button  class="btn btn-rejeitado rejeitado b-rejeitado">
	 		<a style="color: #fff; text-decoration: none;" href="{{ route('requests.negate', $route_args) }}">
	 			Rejeitar</a>
	 	</button>
	</div>

@endif
