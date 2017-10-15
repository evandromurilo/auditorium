@extends('layouts.app')

@section('title', $request->auditorium->name.' ('.$request->dateC->format('d/m/Y') .')')

@section('content')
		<div>
			<h1>{{ $request->event }} ({{ $request->dateC->format('d/m/Y') }})</h2>
			<p><strong>Local:</strong> {{ $request->auditorium->name }}</p>
			<p><strong>Descrição:</strong> {{ $request->description }}</p>
			<p><strong>Organizador:</strong> {{ $request->user->name }}</p>
			<p><strong>Status:</strong> 
			@if ($request->status == 0)
				pendente
			@elseif ($request->status == 1)
				rejeitado
			@elseif ($request->status == 2)
				aceito
			@endif
			</p>
		</div>
@endsection
