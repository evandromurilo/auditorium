<div class="row hour-secundario">
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
      <p>{{ $statusOn->getFirstRequest($period_code)->event }}</p>
    @endif
  </div>
</div>
