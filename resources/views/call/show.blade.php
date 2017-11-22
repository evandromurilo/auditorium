@extends('layouts.app')

@section('title', '{{ $call->title }}')

@section('content')
	<call :user_id="{{ Auth::id() }}"
		:users="{{ \App\User::all() }}"></call>
@endsection
