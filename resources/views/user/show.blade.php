@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<h2 class="text-justify user-top">{{ $user->name }}</h2>


					<div class="well" style="background-color:{{ $user->color }};">
							<p class="letra-perfil text-center">{{ $user->name[0] }}</p>
					</div>


					@if (Auth::user()->isAn('admin') || $user->id == Auth::id())
						<a href="{{ route('users.edit', $user->id) }}">
							<button type="button" class="btn">Editar Perfil
							 	<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						 </button>
					 </a>
				 @endif


					 @if ($user->isAn('admin'))
						 <p>Administrador</p>
					 @elseif ($user->isAn('secre'))
						 <p>Secretário (a)</p>
					 @elseif ($user->isAn('coord'))
						 <p>Coordenador (a)</p>
					 @endif
				<p>{{ $user->description }}</p>
				<p>{{ $user->email }} <i class="fa fa-envelope-o" aria-hidden="true"></i></p>
				<p>{{ $user->cel }}</p>
				<form id="call-form" method="POST" action="{{ route('calls.store') }}">
					{{ csrf_field() }}
					<input type="hidden" name="user_id" value="{{ $user->id }}">
					<input type="hidden" name="title" value="{{ $user->name }}">
					@if ($user->id != Auth::id())
					<p id="chat-button" class="chat" data-toggle="tooltip" title="Chamar '{{ $user->name }}' para conversa!" onclick="$('#call-form').submit()">
						Chat
						<i class="fa fa-comments-o" aria-hidden="true"></i>
					</p>
					@endif
				</form>
			</div>

			<div class="col-md-8 col-lg-8">

					<h2 class="text-center historico">Histórico de Agendamentos</h2>
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
									<td style="vertical-align:middle;">{{ $request->auditorium->name }}</td>
									<td style="vertical-align:middle;">{{ $request->dateC->format('d/m/Y') }}</td>

									@if ($request->status == 0)
										</td></td>
										<td align="center" style="vertical-align:middle;">
											<span class="pendente">
												Pendente
												<i class="fa fa-clock-o" aria-hidden="true"></i>
											</span>
										</td>
									@elseif ($request->status == 1)
										<td align="center" style="vertical-align:middle;">
											<span class="indisponivel">
												Rejeitado
												<i class="fa fa-times" aria-hidden="true"></i>
											</span>
										</td>
									@else
										<td align="center" style="vertical-align:middle;">
											<span class="disponivel">
												Aceito
												 <i class="fa fa-check-square" aria-hidden="true"></i>
											 </span>
										 </td>
									@endif

									<td align="center">
										<button style="margin: auto;" type="button"
									 		class="btn btn-primary btn-xs"
											data-toggle="modal"
											href="{{ route('requests.modal', $request->id) }}"
											data-remote="{{ route('requests.modal', $request->id) }}"
											data-target="#modal-super">
											Visualizar
										</button>
									</td>
								</tr>
							@endforeach
					</table>
					{{ $requests->links() }}
				</div>
			</div>
		</div>
	</div>
					@endif
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="modal-super" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		</div>
	</div>
</div>
</div>


		</div>
@endsection

@section('sources')
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/style-user-show.css')}}">
	<link rel="stylesheet" href="{{ asset('css/style-user-request-modal.css')}}">
	<script type="text/javascript" src="{{ asset('js/jquery-user-show.js') }}"></script>



	<script>
		$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
	</script>

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
