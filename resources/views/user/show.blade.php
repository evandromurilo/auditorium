@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <h2 class="user-top">{{ $user->name }}</h2>

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
            </div>

            <div class="col-md-8 col-lg-8">
                <h2 class="text-center historico">Histórico de Agendamentos</h2>
            </div>

            @if ($requests->isEmpty())
                <div  id="texto" class="nenhum-historico text-center">
                    <span>Nenhum agendamento feito.</span>
                </div>
            @else
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="well-historico">
                                @include('partials.user.history_table')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade"
        id="modal-super"
        tabindex="-1"
        role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection

@section('sources')
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style-user-show.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style-user-request-modal.css')}}">

    <script>
        $(document).ready(function(){
            $('body').on('click', '[data-toggle="modal"]', function(){
                $($(this).data("target")+' .modal-content').load($(this).data("remote"));
            });

            function effectFadeIn(classname) {
                var element = $("."+classname);
                setInterval(function() {
                    element.fadeToggle(3000, "linear");
                }, 3000);
            }

            effectFadeIn('nenhum-historico');
        });
    </script>
@endsection
