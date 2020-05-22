@extends('adminlte::page')
@section('title', 'Empresa - Admin Moda')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('empresa.update') }}" method="POST">
            @csrf
            @method('PUT')
            @if(session()->has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="nome" required value="{{ $empresa['nome_empresa'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Email</label>
                    <input type="text" class="form-control" placeholder="E-mail" name="email_empresa" required value="{{ $empresa['email_empresa'] }}">
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Atualizar</button>
        </form>
    </div>
</div>
@endsection
