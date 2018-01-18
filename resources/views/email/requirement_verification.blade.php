<link rel="stylesheet" href="{{asset('css/style-requirement-verification.css')}}">
<style media="screen">
.button{
    background-color: #2a88bd;
    border: 1px solid #2a88bd;
    border-radius: 8px;
  }
  a{
			text-decoration: none;
      font-size: 14px;
			color:#fff;
			padding: 20px 10px 20px 10px;
		}
		a:hover{
			color:#fff;
		}
    p{
			font-size: 15px;
      color: #777;
		}
    h1{
      color:#777;
    }
    .btn-confirmation{
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .title{
      display: inline;
    }
    a, p, h1{
      font-family: 'Lato', sans-serif;
    }
</style>
<h1 class="title">{{ $requirement->name }}</h1><p class="title">,precisam da sua presença!</p><br><br>
<p>Evento: {{ $requirement->request->event }}</p>
<p>Data: {{ $requirement->request->dateC->format('d/m/Y') }}</p><i class="fa fa-calendar" aria-hidden="true"></i>
<p>Horário: {{ $requirement->request->periodTimeF }}</p>
<p>Local: {{ $requirement->request->auditorium->name }}</p>

<div class="btn-confirmation">

    <a class="button" href="{{ route('requirements.updateVerification',
      ['id' => $requirement->id, 'hash' => $verification->hash]) }}" class="btn btn-success btn-lg">
      Clique para confirmar a presença
    </a>

</div>
