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
				<a href="{{ route('users.edit', $user->id) }}">Editar Perfil</a>
				<p>{{ $user->description }}</p>
				<p>{{ $user->email }} <i class="fa fa-envelope-o" aria-hidden="true"></i></p>
				<p>{{ $user->cel }}</p>
				<p class="chat">Chat <i class="fa fa-comments-o" aria-hidden="true"></i></p>
			</div>

			<div class="col-md-8 col-lg-8">

					<h2 class="text-center">Histórico de Agendamentos</h2>
					@if ($requests->isEmpty())
						<div  id="texto" class="nenhum-historico text-center">
							<apan>Nenhum histórico agendamento feito.</apan>
						</div>
					@else
						</div>

						<div class="container">
							<div class="row">
								<div class="col-md-8">
								<div class="well-historico">

									<table class="table table-bordered">
										<tr>
											<th class="text-center">Auditório</th>
											<th class="text-center">Data do Agendameto</th>
											<th class="text-center">Status</th>
										</tr>

							@foreach ($requests as $request)
										<tr>


								<td>{{ $request->auditorium->name }}</td>
								<td>{{ $request->dateC->format('d/m/Y') }}</td>


								@if ($request->status == 0)
								<td><span class="rejeitado">(Pendente)</span></td>
								@elseif ($request->status == 1)
								<td><span class="indisponivel">(Rejeitado)</span><td>
									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
									 Abrir
									</button>
								</td></td>
								@else
								<td><span class="disponivel">(Aceito)</span><td>
									<button type="button" request="{{$request->id}}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
									 Abrir
									</button>
								</td></td>
								@endif
							@endforeach
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
					@endif
		</div>
	</div>

			@foreach ($requests as $request)
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel"></h4>
			      </div>
			      <div class="modal-body">
							<!--exemplo teste-->
			       <h2>{{ $request->auditorium->name }}</h2>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach




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
