<div class="row">
  @if ($code == 1)
    <div class="col-md-2 col-lg-2 control-label status-color-green">
  @elseif ($code == 0)
    <div class="col-md-2 col-lg-2 control-label status-color-orange">
  @else
    <div class="col-md-2 col-lg-2 control-label status-color-red">
  @endif

  </div>
  <div class="col-md-6 col-lg-6 control-label">
    <p>{{ App\Helpers\StatusFormatting::periodTimeF($period_code) }}</p>
  </div>
  <div class="col-md-4 col-lg-4 control-label ">
    @if ($code == 1)
      <p>Disponível</p>
    @else
      <p>{{ $statusOn->getFirstRequest($period_code)->event }}</p>
    @endif
  </div>
</div>
