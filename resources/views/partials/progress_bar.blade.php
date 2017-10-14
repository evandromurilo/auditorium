<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->

@if ($code == 0)
<div class="progress-bar"  style="width: 33.33%; background-color: #FF8C00;"  data-toggle="tooltip" data-placement="top" title="Pendente">{{ $period }}
	<span class="sr-only">Pendente para a {{ $period }}.</span>
</div>
@elseif ($code == 1)
<div class="progress-bar"  style="width: 33.33%; background-color: green;"  data-toggle="tooltip" data-placement="top" title="Disponível">{{ $period }}
	<span class="sr-only">Disponível para a {{ $period }}.</span>
</div>
@else
<div class="progress-bar"  style="width: 33.33%; background-color: red;" data-toggle="tooltip" data-placement="top" title="Indisponível">{{ $period }}
	<span class="sr-only">Indisponível para a {{ $period }}.</span>
</div>
@endif

<script>
$(function() {
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
