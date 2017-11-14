@if ($request->status == 0)
	<a href="{{ route('requests.accept', $route_args) }}"
		class="btn btn-success">Aceitar</a>

	<a href="{{ route('requests.negate', $route_args) }}"
		class="btn btn-danger">Rejeitar</a>
@elseif ($request->status == 1)
	<a href="{{ route('requests.accept', $route_args) }}"
		class="btn btn-success">Aceitar</a>

	<a href="{{ route('requests.pending', $route_args) }}"
		 class="btn btn-warning">Pendurar</a>
@elseif ($request->status == 2) 
	<a href="{{ route('requests.pending', $route_args) }}"
		class="btn btn-warning">Pendurar</a>

	<a href="{{ route('requests.negate', $route_args) }}"
		class="btn btn-danger">Rejeitar</a>
@endif
