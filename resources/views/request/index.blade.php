@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')

	<div class="container">
		<div class="row">
			<h1 class="text-center title-pedido">Pedidos</h1>
			<nav class="navbar navbar-default sub-menu" role="navigation">
					<div class="collapse navbar-collapse" id="navbar">
		          <ul class="nav navbar-nav">
		            <li><a href="{{ route('requests.index', ['filter' => 'pending']) }}"
		              class=" {{ $filter == 'pending' ? 'active' : ''}}">Pendentes</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'all']) }}"
		              class=" {{ $filter == 'all' ? 'active' : ''}}">Todos</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'resolved']) }}"
		              class=" {{ $filter == 'resolved' ? 'active' : '' }}">Resolvidos</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'rejected']) }}"
		              class=" {{ $filter == 'rejected' ? 'active' : '' }}">Rejeitados</a></li>
		            <li><a href="{{ route('requests.index', ['filter' => 'accepted']) }}"
		              class=" {{ $filter == 'accepted' ? 'active' : '' }}">Aceitos</a></li>
		          </ul>
						</div>
					</div>
				</div>
		</nav>

	<div class="container">
		<div class="row">
				@foreach ($requests as $request)
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"
               request-id="{{ $request->id }}">
						<div class="well">
							<h2 class="text-center title-auditorio">
								<a class="title-pedidos" href="{{ route('requests.show', $request->id) }}">
									{{ $request->auditorium->name }}
								</a>
							</h2>
							<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label ls">Evento:</span>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ls">
								<span>{{ $request->event }}</span>
							</div>

							<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label ls">Data:</span>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ls">
								 {{ $request->dateC->format('d/m/Y') }}
								 <i class="fa fa-calendar" aria-hidden="true"></i>
							</div>

							<span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label ls">Horário:</span>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ls">
                {{ $request->beginning->beginningF }} às {{ $request->end->endF }}
							</div>

							 <span class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label ls">Responsável:</span>
							 <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ls">
								 <a class="responsavel" href="{{ route('users.show', $request->user_id) }}">

										{{ $request->user->name }}


 								</a>
 							</div>

							<?php $route_args = ["id" => $request->id, "from" => "index",
								"filter" => $filter] ?>
							@include('partials.request.request_status_update_index')
						</div>
					</div>
				@endforeach
			</div>
			{{ $requests->appends(['filter' => $filter])->links() }}
		</div>
@endsection

@section('sources')

	<link rel="stylesheet" href="{{ asset('css/style-auditorium-index.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style-request-index.css') }}">

@endsection

<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
    $('#justification-modal [name=from]').val('index');
    $('#justification-modal [name=filter]').val('{{ $filter }}');

    $('.b-pendurado').on('click', function(e){
      e.preventDefault();

      var target = $(e.target);
      var request_id = target.closest('[request-id]').attr('request-id');

      $('#justification-modal form').attr('action', '/requests/'+request_id+'/pending');
      $('#justification-modal').modal('show');
    });

    $('.b-rejeitado').on('click', function(e){
      e.preventDefault();

      var target = $(e.target);
      var request_id = target.closest('[request-id]').attr('request-id');

      $('#justification-modal form').attr('action', '/requests/'+request_id+'/negate');
      $('#justification-modal').modal('show');
    });
  });

</script>
