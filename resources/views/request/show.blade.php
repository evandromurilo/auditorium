@extends('layouts.app')

@section('title', $request->auditorium->name.' ('.$request->dateC->format('d/m/Y') .')')

@section('content')
	<link rel="stylesheet" href="{{ asset('css/style-request-show.css')}}">
	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style-request-status-update-show.css')}}">


		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading text-left" style="color:#000;">Pedido
							<span style="float:right;">{{ $request->auditorium->name }}</span>
						</div>
						<h3 class="text-center title-event">{{ $request->event }}</h3>
						<form class="form-horizontal">

							<div class="form-group">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Data:</label>
								<div class="col-sm-10 col-md-10 col-lg-10">
									<p class="form-control-static"> ({{ $request->dateC->format('d/m/Y') }})
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Local:</label>
								<div class="col-sm-10 col-md-10 col-lg-10">
									<p class="form-control-static"> {{ $request->auditorium->name }}</p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 col-md-2 col-lg-2 control-label">Descrição:</label>
								<div class="col-sm-10 col-md-10 col-lg-10">
									<p class="form-control-static"> {{ $request->description }}</p>
								</div>
							</div>

                <div class="form-group">
                  <label class="col-sm-2 col-md-2 col-lg-2 control-label">Agendado por:</label>
                  <div class="col-sm-10 col-md-10 col-lg-10">
                    <p class="form-control-static">
                       <a class="organizador" href="{{ route('users.show', $request->user_id) }}">
                      {{ $request->user->name }}
                      <i class="fa fa-user-o" aria-hidden="true"></i>
                    </a></p>
                  </div>
                </div>

              @if (!empty($request->claimant))
                <div class="form-group">
                  <label class="col-sm-2 col-md-2 col-lg-2 control-label">Requerente:</label>
                  <div class="col-sm-10 col-md-10 col-lg-10">
                    <p class="form-control-static">
                      {{ $request->claimant }}
                    </p>
                  </div>
                </div>
              @endif

              @if (sizeof($request->requirements) > 0)
                <div class="form-group">
                  <label class="col-sm-2 col-md-2 col-lg-2 control-label">Requisitos:</label>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                      @foreach ($request->requirements as $item)
                        <p> {{ $item->name }}
                        @can('resolve', \App\Requirement::class)
                          <button class="grant" target="{{$item->id}}">grant</button>
                          <button class="ungrant" target="{{$item->id}}">ungrant</button>
                        @endcan
                        </p>
                      @endforeach
                    </div>
                </div>
              @endif
						</form>

            <div class="btn-pedidos">
              @can('resolve', \App\Request::class)
                <?php $route_args = ["id" => $request->id, "from" => "show"] ?>
              @include('partials.request.request_status_update_show')
            @else
              @if (Auth::id() == $request->user_id and $request->status != 1)
                <?php $route_args = ["id" => $request->id, "from" => "show"] ?>
                <a class="btn btn-cancelar" href="{{ route('requests.negate', $route_args) }}">
                  Cancelar
                </a>
              @endif
						@endcan
            </div>

						<!--move essa parte para cima-->
						<!-- parte do status comentado para arrumar depois-->
						<!--
							@if ($request->status == 0)
								<span class="pendente" style="background-color: #FF8C00;">Pendente</span>
							@elseif ($request->status == 1)
								<span class="indisponivel" style="background-color: red;">Rejeitado</span>
							@elseif ($request->status == 2)
								<span class="disponivel" style="background-color: green;">Aceito</span>
							@endif-->


					</div>
				</div>
			</div>
		</div>

@endsection

<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
    $('.grant').on('click', function(e){
      e.preventDefault();
      console.debug($(e.target).attr('target'));
      var id = $(e.target).attr('target');
      var data = {};
      data['_token'] = $('input[name=_token]').val();
      data['_method'] = 'PUT';

      $.ajax({
        url: '/requirements/'+id+'/grant',
        method: 'POST',
        dataType: 'json',
        data: data,
        complete: function(data) {
          console.debug(data);
        }
      });
    });

    $('.ungrant').on('click', function(e){
      e.preventDefault();
      var id = $(e.target).attr('target');
      var data = {};
      data['_token'] = $('input[name=_token]').val();
      data['_method'] = 'PUT';

      $.ajax({
        url: '/requirements/'+id+'/ungrant',
        method: 'POST',
        dataType: 'json',
        data: data,
        complete: function(data) {
          console.debug(data);
        }
      });
    });
  });
</script>
