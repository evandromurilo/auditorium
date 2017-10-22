@extends('layouts.app')

@section('title', '{{ $call->title }}')

@section('content')
	<call :call="{{ $call }}"
		:messages="{{ $call->messages }}"
		:user_id="{{ Auth::id() }}"
		:members="{{ $call->members }}"
		:users="{{ \App\User::all() }}"
		:calls="{{ Auth::user()->calls->reverse() }}"></call>
@endsection
