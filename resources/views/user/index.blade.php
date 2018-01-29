@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
	<div class="container">
		<div class="row">
			<h1 class="text-left title-user">Usuários</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
				@foreach ($users as $user)
          @if ($user->active or Auth::user()->isAn('admin'))
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 caixa-size">
                <a class="user" href="{{ route('users.show', $user->id) }}">
                  {{$user->name }}
                    <i style="color: {{ $user->color }}"
                       class="fa fa-circle-o"
                       aria-hidden="true"></i>
                </a>

                @if (!$user->active)
                  (inativo)
                @endif

                <div class="row">
                  <label class="col-md-2 control-label">Cargo: </label>
                  <span class="col-md-10">{{ $user->description}}</span>
                </div>
            </div>
          @endif
				@endforeach
		</div>
	</div>

@endsection

@section('sources')

<link rel="stylesheet" href="{{ asset('css/style-user-index.css')}}">

@endsection
