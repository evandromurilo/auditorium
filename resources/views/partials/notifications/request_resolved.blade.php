<link rel="stylesheet" href="{{ asset('css/style-norificaton-request-resolver.css') }}">

<?php $request = \App\Request::find($notification->data['request_id']) ?>
<li><a onclick="markRequestNotificationAsRead({{$request->id}})"
			 href="{{ route('requests.show', ['id'=>$request->id, 'from' => 'notification']) }}">
			 <div class="text-justify">Sua requisição do {{ $request->auditorium->name }} mudou de status.<br>
			 <span style="color:gray; font-size: 0.8em; float:right; font-family:'Yantramanav', sans-serif; margin-bottom: 10px;">
				  <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $notification->created_at }}</span>
			 </div></a>
</li>
