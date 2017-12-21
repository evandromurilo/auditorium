@if ($code == 1)
  <?php $url = route('requests.create', ['date' => $date->format('d/m/Y'),
    'id' => $aud->id, 'period' => $period_code]) ?>
@else
  <?php $request = $statusOn->getFirstRequest($period_code) ?>
  <?php $url = route('requests.show', $request->id) ?>
@endif

<div class="row hour-secundario" onclick="location.href='{{ $url }}';" style="cursor: pointer;">
  @if ($code == 1)
    <div class="col-md-2 col-lg-2 control-label">
      <i class="fa fa-ellipsis-v status-color-green " aria-hidden="true"></i>
  @elseif ($code == 0)
    <div class="col-md-2 col-lg-2 control-label ">
        <i class="fa fa-ellipsis-v status-color-orange" aria-hidden="true"></i>
  @else
    <div class="col-md-2 col-lg-2 control-label">
      <i class="fa fa-ellipsis-v status-color-red" aria-hidden="true"></i>
  @endif

  </div>
  <div class="col-md-6 col-lg-6 control-label">
    <p class="horas">{{ App\Helpers\StatusFormatting::periodTimeF($period_code) }}</p>
  </div>
  <div class="col-md-4 col-lg-4 control-label ">
    @if ($code == 1)
        <p>Disponível</p>
    @else
        <p>{{ $request->event }}</p>
    @endif
  </div>
</div>
