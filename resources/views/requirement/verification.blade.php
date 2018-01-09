@extends('layouts.app')

@section('title', 'Novo Pedido')

@section('content')
  <h1>Responder à requisição</h1>
  <p>Evento: {{ $requirement->request->event }}</p>
  <p>Data: {{ $requirement->request->dateC->format('d/m/Y') }}</p>
  <p>Horário: {{ $requirement->request->periodTimeF }}</p>
  <p>Local: {{ $requirement->request->auditorium->name }}</p>
  <button class="btn btn-primary"
          id="btn-confirm">
        Estarei presente
  </button>
  <button class="btn btn-primary"
          id="btn-negate">
        Não poderei comparecer
  </button>
@endsection

<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
    $('.btn').on('click', function(e){
      e.preventDefault();

      var target = $(e.target);
      var target_id = target.attr('id');

      console.log(target_id == 'btn-confirm');

      var data = {};
      data['_token'] = $('meta[name=csrf-token]').attr('content');
      data['_method'] = 'PUT';
      data['confirm'] = (target_id == 'btn-confirm');
      data['hash'] = '{{ $verification->hash }}';

      console.debug(data);

      $.ajax({
        url: '/requirements/'+'{{ $requirement->id }}'+'/verification',
        method: 'POST',
        dataType: 'json',
        data: data,
        complete: function(data) {
          console.debug(data);
        }
      });
    });
  });
</script>
