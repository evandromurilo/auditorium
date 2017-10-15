<?php $request = \App\Request::find($notification->data['request_id']) ?>
<li><a onclick="markRequestNotificationAsRead({{$request->id}})"
			 href="{{ route('requests.show', ['id'=>$request->id, 'from' => 'notification']) }}">
			 Sua requisição do {{ $request->auditorium->name }} mudou de status.</a></li>
