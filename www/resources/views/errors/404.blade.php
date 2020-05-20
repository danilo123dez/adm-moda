@extends('adminlte::page')
@section('title', 'Lançamentos - Admin Moda')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1> {{ !empty($message) ? $message : 'Esta página não existe' }} 😔 </h1>
        </div>
    </div>
@endsection
