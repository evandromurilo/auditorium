@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Cria Usuário</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Nome</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Senha</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">Confirme a Senha</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
								<label for="color" class="col-md-4 control-label">Cor</label>

								<div class="col-md-3">
									<input id="color" type="text" class="form-control" name="color" value="{{ sprintf('#%06X', mt_rand(0, 0xFFFFFF)) }}" required>

									@if ($errors->has('color'))
										<span class="help-block">
											<strong>{{ $errors->first('color') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-3">
										<div class="circle" id="cor"></div>
								</div>
							</div>

							<div class="form-group{{ $errors->has('cel') ? ' has-error' : '' }}">
								<label for="cel" class="col-md-4 control-label">Celular</label>

								<div class="col-md-6">
									<input id="cel" type="text" class="form-control" name="cel" value="{{ old('cel') }}" required>

									@if ($errors->has('cel'))
										<span class="help-block">
											<strong>{{ $errors->first('cel') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								<label for="description" class="col-md-4 control-label">Cargo</label>

								<div class="col-md-6">
									<input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">

									@if ($errors->has('description'))
										<span class="help-block">
											<strong>{{ $errors->first('description') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Cadastrar-se
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('sources')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.5.2/randomColor.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-script-register.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/style-register.css')}}">
@endsection
