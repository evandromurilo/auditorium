<?php $status = $aud->statusOn($date, $period) ?>

@if ($status == 0)
    <div class="progress-bar"
         style="width: 14.286%; background-color: #FF8C00;"
         data-toggle="tooltip"
         data-placement="top"
         title="Pendente">
        <span class="sr-only">Pendente para a {{ $period->name }}.</span>
    </div>

@elseif ($status == 1)
    @if ($canRequest)
        <div class="progress-bar"
             style="width: 14.286%; background-color: green;"
             data-toggle="tooltip"
             data-placement="top"
             title="Disponível">
            <span class="sr-only">Disponível para a {{ $period->name }}.</span>
        </div>
    @else
        <div class="progress-bar"
             style="width: 14.286%; background-color: green;"
             data-toggle="tooltip"
             data-placement="top"
             title="Bloqueado">
            <span class="sr-only">Bloqueado para a {{ $period->name }}.</span>
        </div>
    @endif

@else
    <div class="progress-bar"
         style="width: 14.286%; background-color: red;"
         data-toggle="tooltip"
         data-placement="top"
         title="Indisponível">
        <span class="sr-only">Indisponível para a {{ $period->name }}.</span>
    </div>
@endif
