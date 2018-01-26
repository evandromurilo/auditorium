@extends('layouts.app')

@section('title', 'Verificação')

@section('content')

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
   crossorigin="anonymous">
   
  <div class="container">
    <div class="row">
			<div class="col-md-12 col-lg-12">

          <h1 id="verification-title" class="text-center">Responder à requisição</h1>
          <div class="form-group">
            <label class="col-md-2 control-label">Evento:</label>
            <div class="col-md-10">
              <p>{{ $requirement->request->event }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Data:</label>
            <div class="col-md-10">
              <p> {{ $requirement->request->dateC->format('d/m/Y') }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Horário:</label>
            <div class="col-md-10">
              <p>{{ $request->beginning->beginningF }} às {{ $request->end->endF }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Local:</label>
            <div class="col-md-10">
              <p> {{ $requirement->request->auditorium->name }}</p>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

            <button class="btn btn-primary"
            id="btn-confirm">
            Estarei presente
          </button>

            <button class="btn btn-primary"
            id="btn-negate">
            Não poderei comparecer
          </button>
          </div>
        </div>
        </div>
      </div>
    </div>
<div id="response" style="color: green; font-size:20px; display: flex; align-items: center; justify-content: center; margin: 20px 0 0 0;"></div>
@endsection

<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
    $('#btn-confirm, #btn-negate').on('click', function(e){
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
