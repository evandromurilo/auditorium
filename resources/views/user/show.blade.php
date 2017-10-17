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
				<form method="POST" action="{{ route('calls.store') }}">
					{{ csrf_field() }}
					<input type="hidden" name="user_id" value="{{ $user->id }}">
					<input type="hidden" name="title" value="{{ $user->name }}">
					<input type="submit" value="Chamada">
				</form>
			</div>

			<div class="col-md-8 col-lg-8">

					<h2 class="text-center">Histórico de Agendamentos</h2>
					@if ($requests->isEmpty())
						<div  id="texto" class="nenhum-historico text-center">
							<span>Nenhum agendamento feito.</span>
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
										<td><span class="pendente">Pendente</span></td>
										</td></td>
									@elseif ($request->status == 1)
										<td><span class="indisponivel">Rejeitado</span></td>
									@else
										<td><span class="disponivel">Aceito</span></td>
									@endif

									<td>
										<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal{{$request->id}}">
											Visualizar
										</button>
									</td>
								</tr>
							@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
					@endif
		</div>
	</div>

			@foreach ($requests as $request)
				<div class="modal fade" id="modal{{$request->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel"></h4>
			      </div>
			      <div class="modal-body">
							<!--exemplo teste-->
							<a href="{{ route('requests.show', $request->id) }}">
								<h2 class="text-center">{{ $request->event }}</h2>
							</a>

						 <div class="row">
							 <label class="col-md-2 control-label">Data: </label>
								<div class="col-md-8">
										<p>{{ $request->dateC->format('d/m/Y') }}</p>
								</div>
						 </div>

						 <div class="row">
							 <label class="col-md-2 control-label">Local: </label>
								<div class="col-md-8">
									<p>{{ $request->auditorium->name }}</p>
								</div>
						 </div>

						 <div class="row">
							 <label class="col-md-2 control-label">Descrição: </label>
								 <div class="col-md-8">
									  <p>{{ $request->description }}</p>
								 </div>
						 </div>

						</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach
		</div>
@endsection

@section('sources')
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/style-user-show.css')}}">
	<script type="text/javascript" src="{{ asset('js/jquery-user-show.js') }}"></script>

	<script type="text/javascript">
	function effectFadeIn(classname) {
		var element = $("."+classname);
		setInterval(function() {
			element.fadeToggle(3000, "linear");
			}, 3000);
	}
	$(document).ready(function(){
		effectFadeIn('nenhum-historico');
	});
	</script>

	<script type="text/javascript">
	$(document).ready(function(){
    function alignModal(){
        var modalDialog = $(this).find(".modal-dialog");

        modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
    }

    $(".modal").on("shown.bs.modal", alignModal);


    $(window).on("resize", function(){
        $(".modal:visible").each(alignModal);
    });
});
</script>
@endsection
