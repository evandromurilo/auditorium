<?php $status = $aud->statusOn($date, $period) ?>

@if ($status == 1)
  @if ($canRequest)
    <?php $url = route('requests.create', ['date' => $date->format('d/m/Y'),
    'id' => $aud->id, 'period' => $period->id]) ?>

  @else
    <?php $url = "#" ?>
  @endif
@else
  <?php
    $request = $period->requests()
      ->where('date', $date->toDateString())
      ->where('auditorium_id', $aud->id)
      ->where('status', '!=', 1)
      ->first();

    $url = route('requests.show', $request->id)
  ?>
@endif

<div class="row hour-secundario" onclick="location.href='{{ $url }}';" style="cursor: pointer;">
  <div class="col-md-2 col-lg-2 control-label">
  @if ($status == 1)
    <i class="fa fa-ellipsis-v status-color-green " aria-hidden="true"></i>
  @elseif ($status == 0)
    <i class="fa fa-ellipsis-v status-color-orange" aria-hidden="true"></i>
  @else
    <i class="fa fa-ellipsis-v status-color-red" aria-hidden="true"></i>
  @endif

  </div>
  <div  class="col-md-6 col-lg-6 control-label">
    <p  class="horas">{{ $period->beginningF }} às {{ $period->endF }}</p>
  </div>
  <div class="col-md-4 col-lg-4 control-label">
    @if ($status == 1)
      @if ($canRequest)
        <p class="text-center disponivel-btn">Disponível</p>
      @else
        <p class="text-center disponivel-btn">Bloqueado</p>
      @endif
    @else
        <p class="indisponivel-pendente-btn" data-toggle="tooltip" data-placement="top" title="{{ $request->event }}">
          {{ $request->event }}</p>
    @endif
  </div>
</div>
