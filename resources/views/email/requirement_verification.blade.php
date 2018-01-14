<h1>{{ $requirement->name }}, precisam de ti!</h1>
<p>Evento: {{ $requirement->request->event }}</p>
<p>Data: {{ $requirement->request->dateC->format('d/m/Y') }}</p>
<p>Horário: {{ $requirement->request->periodTimeF }}</p>
<p>Local: {{ $requirement->request->auditorium->name }}</p>

<a href="{{ route('requirements.updateVerification',
  ['id' => $requirement->id, 'hash' => $verification->hash]) }}">Clique aqui para responder</a>
