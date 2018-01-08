<h1>Reitor, precisam de ti!</h1>
<p>Evento: {{ $requirement->request->name }}</p>
<p>Dia: {{ $requirement->request->date }}</p>

<button href="{{ route('requirements.updateVerification',
  ['id' => $requirement->id, 'hash' => $verification->hash]) }}">Confirmar presença</button>

<a href="{{ route('requirements.updateVerification',
  ['id' => $requirement->id, 'hash' => $verification->hash]) }}">Confirmar presença</a>
