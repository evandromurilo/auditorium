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
      color: #000;
		}
    h1{
      color:#000;
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
    .style-information, .style-variavel{
      display: inline;
      color: #000;
    }
    .style-information{
      color:#fff;
			border: 1px solid #777;
			border-radius: 5px;
			padding: 4px 10px 4px 10px;
			background-color: #777;
    }
</style>

<h1 class="title">{{ $requirement->name }}</h1><p class="title">,precisam da sua presença!</p><br><br><br>
<p class="style-variavel">Evento: </p><p class="style-information"> {{ $requirement->request->event }}</p><br><br>
<p class="style-variavel">Data: </p><p class="style-information">{{ $requirement->request->dateC->format('d/m/Y') }}</p><br><br>
<p class="style-variavel">Horário: </p><p class="style-information">{{ $requirement->request->periodTimeF }}</p><br><br>
<p class="style-variavel">Local: </p><p class="style-information">{{ $requirement->request->auditorium->name }}</p><br><br><br>

<!--button confirmar-->
<div class="btn-confirmation">
    <a class="button" href="{{ route('requirements.updateVerification',
      ['id' => $requirement->id, 'hash' => $verification->hash]) }}">
      Clique para confirmar a presença
    </a>
</div>
