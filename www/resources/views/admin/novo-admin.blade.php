
@extends('adminlte::page')
@section('title', 'Administradores - Admin Moda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Novo administrador</h3>
    </div>
    <div class="card-body">
        <form class="js--form-store-admin" action="{{ route('novo.admin.store') }}" method="POST">
            @csrf
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
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome do novo adiministrador" value="{{ old('nome') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>CPF</label>
                    <input type="text" class="form-control" name="cpf" placeholder="CPF" value="{{ old('cpf') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>Telefone</label>
                    <input type="text" class="form-control" name="numero" placeholder="Telefone" value="{{ old('numero') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>Senha</label>
                    <input type="password" class="form-control js--password" name="password" placeholder="Senha" minlength="6" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3 js--div-confirm-pass">
                    <label>Confirme a senha</label>
                    <input type="password" class="form-control js--confirm-pass" name="confirm_pass" placeholder="Confirme a senha" minlength="6" required>
                </div>
            </div>
            <a href="{{route('admin.index')}}" class="btn btn-light" style="margin-right: 50px;">Voltar</a>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </div>
</div>
@endsection

@section('adminlte_js')
    <script src="{{ asset('/js/recuperar-senha.js') }}"></script>
@stop
