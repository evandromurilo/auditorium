@if ($code == 0)
<div class="progress-bar"  style="width: 14.286%; background-color: #FF8C00;"  data-toggle="tooltip" data-placement="top" title="Pendente">
	<span class="sr-only">Pendente para a {{ $period }}.</span>
</div>
@elseif ($code == 1)
      @if ($canRequest)
        <div class="progress-bar"  style="width: 14.286%; background-color: green;"  data-toggle="tooltip" data-placement="top" title="Disponível">
        <span class="sr-only">Disponível para a {{ $period }}.</span>
      @else
        <div class="progress-bar"  style="width: 14.286%; background-color: green;"  data-toggle="tooltip" data-placement="top" title="Bloqueado">
        <span class="sr-only">Bloqueado para a {{ $period }}.</span>
      @endif
</div>
@else
<div class="progress-bar"  style="width: 14.286%; background-color: red;" data-toggle="tooltip" data-placement="top" title="Indisponível">
	<span class="sr-only">Indisponível para a {{ $period }}.</span>
</div>
@endif


<!-- tirei todos os {{--$period--}} para não aparecer mais no front caso precisar so colocar novamente*/-->
