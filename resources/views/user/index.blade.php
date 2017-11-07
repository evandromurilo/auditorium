@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
	<div class="container">
		<div class="row">
			<h1 class="text-left">Usuários</h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
				@foreach ($users as $user)
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<div class="well" style="border: 1px solid {{ $user->color }};">
							<a class="user" href="{{ route('users.show', $user->id) }}">
								{{ $user->name }}
							</a>

							<div class="row">
								<label class="col-md-4 control-label">Cargo: </label>
								<span class="col-md-8">{{ $user->description}}</span>
							</div>

						</div>
					</div>
				@endforeach
		</div>
	</div>

@endsection

@section('sources')

<link rel="stylesheet" href="{{ asset('css/style-user-index.css')}}">

@endsection
