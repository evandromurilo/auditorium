@extends('layouts.app')

@section('title', 'Nova Chamada')

@section('content')
	<new-call
		:user="{{ Auth::user() }}"
		:users="{{ $users }}"></new-call>
@endsection
