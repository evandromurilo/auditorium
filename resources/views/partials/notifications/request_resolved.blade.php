<?php $request = \App\Request::find($notification->data['request_id']) ?>
<li><a onclick="markRequestNotificationAsRead({{$request->id}})"
			 href="{{ route('requests.show', ['id'=>$request->id, 'from' => 'notification']) }}">
			 <div>Sua requisição do {{ $request->auditorium->name }} mudou de status.<br>
			 <span style="color:gray; font-size: 0.8em;">{{ $notification->created_at }}</span>
			 </div></a>
</li>
