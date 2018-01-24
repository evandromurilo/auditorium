@extends('layouts.app')

@section('title', 'Verificação')

@section('content')

  <div class="">
    <div class="">
			<div class="">
				<div class="">
          <h1 id="verification-title" class="text-center">Responder à requisição</h1>
          <p>Evento: {{ $requirement->request->event }}</p>
          <p>Data: {{ $requirement->request->dateC->format('d/m/Y') }}</p>
          <p>Horário: {{ $requirement->request->periodTimeF }}</p>
          <p>Local: {{ $requirement->request->auditorium->name }}</p>
          <div class="btn-principal">
            <button style="color: #fff;" class="btn-primary"
            id="btn-confirm">
            Estarei presente
          </button>
          <button style="color: #fff;" class=""
          id="btn-negate">
          Não poderei comparecer
        </button>
          </div>
          <div id="response" style="color: green;"></div>
        </div>
      </div>
    </div>
  </div>

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
          if (target_id == 'btn-confirm') {
            $('#response').text('Presença confirmada!');
          }
          else {
            $('#response').text('Ausência confirmada.');
          }
        }
      });
    });
  });
</script>
