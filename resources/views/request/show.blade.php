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
                                <p class="form-control-static">
                                {{ $request->dateC->format('d/m/Y') }}
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 col-lg-2 control-label">
                                Horário:
                            </label>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <p class="form-control-static">
                                {{ $request->beginning->beginningF }} às {{ $request->end->endF }}
                                </p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 col-lg-2 control-label">Local:</label>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <p class="form-control-static">
                                    {{ $request->auditorium->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 col-lg-2 control-label">
                                Descrição:
                            </label>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <p class="form-control-static"> {{ $request->description }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 col-lg-2 control-label">
                                Agendado por:
                            </label>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <p class="form-control-static">
                                    <a class="organizador"
                                       href="{{ route('users.show', $request->user_id) }}">
                                       {{ $request->user->name }}
                                       <i class="fa fa-user-o" aria-hidden="true"></i>
                                    </a>
                                </p>
                            </div>
                        </div>

                        @if (!empty($request->claimant))
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 col-lg-2 control-label">
                                    Requerente:
                                </label>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <p class="form-control-static">
                                    {{ $request->claimant }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 col-lg-2 control-label">Status:</label>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <p class="form-control-static">
                                    {{ $request->statusF }}
                                </p>
                            </div>
                        </div>

                        @if (!empty($request->justification))
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 col-lg-2 control-label">
                                    Justificativa:
                                </label>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <p class="form-control-static">
                                        {{ $request->justification }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if (sizeof($request->requirements) > 0)
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 col-lg-2 control-label">
                                    Requisitos:
                                </label>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    @can('resolve', \App\Requirement::class)
                                        <?php $maybeDisabled = "" ?>
                                    @else
                                        <?php $maybeDisabled = "disabled" ?>
                                    @endcan

                                    @foreach ($request->requirements as $item)
                                        <div>
                                            @if ($item->isVerified())
                                                <input type="checkbox"
                                                       class="checkbox-requisitos"
                                                       id="grant-{{ $item->id }}"
                                                       target="{{ $item->id }}"
                                                       disabled
                                                       {{ $item->granted ? "checked" : "" }}>
                                             @else
                                                 <input type="checkbox"
                                                      class="checkbox-requisitos"
                                                      id="grant-{{ $item->id }}"
                                                      target="{{ $item->id }}"
                                                      {{ $maybeDisabled }}
                                                      {{ $item->granted ? "checked" : "" }}>
                                             @endif
                                                     <label class=""
                                                            for="grant-{{ $item->id}}">
                                                            {{ $item->name }}
                                                     </label>
                                                 </input>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($request->auditorium->name == 'Auditório A')
                            <div class="form-group">
                                <div class="col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <strong>Detalhes para o
                                        agendamento do Auditório A, como serviços e equipamentos,
                                        devem ser discutidos através do email
                                        acs.jiparana@ulbra.br</strong>
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
                              <form class="form-horizontal"
                                    method="POST"
                                    action="{{ route('requests.negate', $request->id) }}">
                                  <input type="hidden" name="_method" value="PUT">
                                  <input type="hidden" name="from" value="show">
                                  {{ csrf_field() }}
                                  <button style="color:#fff;"
                                          type="submit"
                                          class="btn btn-cancelar">
                                      Cancelar
                                  </button>
                              </form>
                          @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.checkbox-requisitos').on('change', function(e){
            //e.preventDefault();

            var target = $(e.target);
            var id = target.attr('target');

            console.log(target.is(':checked'));

            if (target.is(':checked')) {
                var action = "grant";
            } else {
                var action = "ungrant";
            }

            console.log(target.is(':checked'));

            var data = {};
            data['_token'] = $('input[name=_token]').val();
            data['_method'] = 'PUT';

            $.ajax({
                url: '/requirements/'+id+'/'+action,
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

<script type="text/javascript">
    $(document).ready(function(){
        $('.b-pendurado').on('click', function(e){
            e.preventDefault();

            var target = $(e.target);

            $('#justification-modal form')
                .attr('action', '{{ route('requests.pending', $request->id) }}');

            $('#justification-modal').modal('show');
        });

        $('.b-rejeitado').on('click', function(e){
            e.preventDefault();

            var target = $(e.target);

            $('#justification-modal form')
                .attr('action', '{{ route('requests.negate', $request->id) }}');

            $('#justification-modal').modal('show');
        });
    });
</script>

