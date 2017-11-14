@if ($code == 1)
	@if ($date->gte(\Carbon\Carbon::today()))
		<a href={{ route('requests.create', ['date' => $date->format('d/m/Y'),
		'id' => $aud->id, 'period' => $period_code]) }}>
		<p class="disponivel">Disponível <i class="fa fa-plus-square" aria-hidden="true"></i></p>
		</a><br>
	@else
		<p class="disponivel">Disponível</p>
		<br>
	@endif
@elseif ($code == 0)
	<p class="pendente">Pendente <i class="fa fa-clock-o" aria-hidden="true"></i></p><br>
@elseif ($code == 2)
	@if ($period_code == 0)
		<?php $first = $statusOn->morning_requests->first() ?>
	@elseif ($period_code == 1)
		<?php $first = $statusOn->afternoon_requests->first() ?>
	@elseif ($period_code == 2)
		<?php $first = $statusOn->night_requests->first() ?>
	@endif
		<a href={{ route('requests.show', $first->id) }}>
			<p class="indisponivel" data-toggle="tooltip" data-placement="top"
				 title="{{ $first->event }}">Indisponível
				 <i class="fa fa-lock" aria-hidden="true"></i>
			</p>
		</a><br>
@endif


