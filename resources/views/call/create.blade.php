@extends('layouts.app')

@section('title', 'Nova Chamada')

@section('content')
	<new-call :user="{{ Auth::user() }}"></new-call>
@endsection
