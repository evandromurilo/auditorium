@if ($code == 0)
<div class="progress-bar progress-bar-warning"  style="width: 33%">{{ $period }}
	<span class="sr-only">Pendente para a {{ $period }}.</span>
</div>
@elseif ($code == 1)
<div class="progress-bar progress-bar-success"  style="width: 33%">{{ $period }}
	<span class="sr-only">Disponível para a {{ $period }}.</span>
</div>
@else
<div class="progress-bar progress-bar-danger"  style="width: 33%">{{ $period }}
	<span class="sr-only">Indisponível para a {{ $period }}.</span>
</div>
@endif
