
@extends('adminlte::page')
@section('title', 'Home - Admin Moda')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('minha.conta.update', ['customer_uuid' => $info_conta['uuid']]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="nome" required value="{{ $info_conta['nome'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Email</label>
                    <input type="text" class="form-control" placeholder="E-mail" name="email" required value="{{ $info_conta['email'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">CPF</label>
                    <input type="text" class="form-control" placeholder="CPF" name="cpf" required value="{{ $info_conta['cpf'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Nome da Empresa</label>
                    <input type="text" class="form-control" placeholder="Nome da Empresa" name="nome_empresa" required value="{{ $info_conta['nome_empresa'] }}">
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Atualizar</button>
        </form>
    </div>
</div>
@endsection
