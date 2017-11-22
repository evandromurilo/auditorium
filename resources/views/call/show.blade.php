@extends('layouts.app')

@section('title', '{{ $call->title }}')

@section('content')
	<call :user_id="{{ Auth::id() }}"
		:users="{{ \App\User::all() }}"
		:first_call_id="{{ $first_call_id }}"></call>
@endsection
