@extends('layouts.app')

@section('title', '403 ERROR')

@section('content')
    <div class="position">
        <h1 class="text-center text-erro">403 ERROR 😑</h1>
        <p class="text-center text">Você não tem permissão para acessar esta página, danadinho!</p>
    </div>

@endsection

@section('sources')
    <link rel="stylesheet" href="{{ asset('css/style-erros.css')}}">
@endsection
