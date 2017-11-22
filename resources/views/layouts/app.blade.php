<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	  <link rel="stylesheet" href="{{ asset('css/style-norificaton-request-resolver.css') }}">

    <!-- font Awesome -->
	  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
	  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <style media="screen">
      .icon{
        float: right;
      }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
											&nbsp;
											<li class="nav-item">
												<a class="nav-link" href="{{ route('auditoria.index') }}">Auditórios </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="{{ route('users.index') }}">Usuários </a>
											</li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Criar Conta</a></li>
                        @else
													<notification  :user_id="{{ Auth::id() }}"></notification>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                            <i class="fa fa-sign-in icon" aria-hidden="true"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
																		@can('resolve', App\Request::class)
																			<li><a href="{{ route('requests.index') }}">Pedidos <i class="fa fa-list icon" aria-hidden="true"></i></a></li>
																		@endcan
																		<li><a href="{{ route('users.show', Auth::id()) }}">
																				Perfil
                                         <i class="fa fa-user-o icon" aria-hidden="true"></i>
																			</a></li>
																		<li><a href="{{ route('calls.index') }}">
																				Chamadas
                                         <i class="fa fa-comments-o icon" aria-hidden="true"></i>
																			</a></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

		@yield('sources')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
