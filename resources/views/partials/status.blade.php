@if ($code == 1)
	<a href={{ route('requests.create', ['date' => $date->format('d/m/Y'),
	'id' => $aud->id]) }}>
	<p class="disponivel">Disponível <i class="fa fa-plus-square" aria-hidden="true"></i></p>
	</a><br>
@elseif ($code == 0)
	<p class="pendente">Pendente <i class="fa fa-clock-o" aria-hidden="true"></i></p><br>
@elseif ($code == 2)
	<p class="indisponivel">Indisponível <i class="fa fa-lock" aria-hidden="true"></i></p><br>
@endif
