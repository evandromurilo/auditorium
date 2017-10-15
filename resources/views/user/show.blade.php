@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<h1>{{ $user->name }}</h1>
				<div class="well" style="background-color:{{ $user->color }};">
						<p class="letra-perfil text-center">{{ $user->name[0] }}</p>
				</div>

				<p>{{ $user->description }}</p>
				<p>{{ $user->email }}</p>
				<p>{{ $user->cel }}</p>
				<p class="chat">Chat <i class="fa fa-comments-o" aria-hidden="true"></i></p>
			</div>

			<div class="col-md-8 col-lg-8">
				<div>
					<h2>Histórico de Agendamentos</h2>
					@if ($requests->isEmpty())
						<div  id="texto" class="nenhum-historico text-center">
							Nenhum agendamento feito.
						</div>
					@else
						@foreach ($requests as $request)
							<p>{{ $request->auditorium->name }} ({{ $request->dateC->format('d/m/Y') }})
							@if ($request->status == 0)
								(pendente)
							@elseif ($request->status == 1)
								(rejeitado)
							@else
								(aceito)
							@endif
							</p>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection

@section('sources')
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/style-user-show.css')}}">
	<script type="text/javascript" src="js/jquery-user-show.js"></script>

	<script type="text/javascript">
	function effectFadeIn(classname) {
	$("."+classname).fadeOut(5000).fadeIn(5000, effectFadeOut(classname))
	}
	function effectFadeOut(classname) {
	$("."+classname).fadeIn(1500).fadeOut(1500, effectFadeIn(classname))
	}
	$(document).ready(function(){
	effectFadeIn('nenhum-historico');
	});
	</script>
@endsection
