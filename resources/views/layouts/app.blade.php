<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style media="screen">
      .icon{
        display: inline;
        float: right;
      }
    </style>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	  <link rel="stylesheet" href="{{ asset('css/style-norificaton-request-resolver.css') }}">
	  <link rel="stylesheet" href="{{ asset('css/style-footer.css') }}">

    <!-- font Awesome -->
	  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
	  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

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
												<a class="nav-link" href="{{ route('home') }}">Auditórios </a>
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
																		@can('resolve', App\Request::class)
																			<li class="dis-inline"><a href="{{ route('requests.index') }}">
                                        Pedidos
                                         <!--<i style="padding-top:4px;" class="fa fa-list icon" aria-hidden="true"></i>-->
                                       </a>
                                     </li>
																		@endcan
																		<li><a href="{{ route('users.show', Auth::id()) }}">
																				Perfil
                                         <!--<i style="padding-top:4px;" class="fa fa-user-o icon" aria-hidden="true"></i>-->
																			</a></li>
																		<li><a href="{{ route('calls.index') }}">
																				Chamadas
                                        <!-- <i style="padding-top:4px;" class="fa fa-comments-o icon" aria-hidden="true"></i>-->
																			</a></li>
																		@can('manage', App\BlockedDate::class)
																			<li><a href="{{ route('blocked-dates.index') }}">
                                        Bloqueio de Datas
                                        <!-- <i style="padding-top:4px;" class="fa fa-calendar icon" aria-hidden="true"></i>-->
                                       </a>
                                     </li>
																		@endcan
                                    <li class="dis-inline">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Sair
                                            <!--<i style="padding-top:4px;" class="fa fa-sign-in icon" aria-hidden="true"></i>-->
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
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
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
