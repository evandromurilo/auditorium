@extends('layouts.app')

@section('title', '{{ $call->title }}')

@section('content')
	<call :call="{{ $call }}"
		:messages="{{ $call->messages }}"
		:members="{{ $call->members }}"></call>
@endsection
