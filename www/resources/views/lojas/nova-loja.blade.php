@extends('adminlte::page')
@section('title', 'Lojas - Admin Moda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Nova Loja</h3>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST">
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
                    <label for="validationCustom03">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome da Loja" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-1">
                    <label for="validationCustom01">Comissão</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">%</span>
                        </div>
                        <input type="number" min="1" max="100" step="0.1" name="comissao" class="form-control" placeholder="Porcentagem de comissão" aria-describedby="inputGroupPrepend" required>
                    </div>
                </div>
            </div>
            <a href="{{route('lojas.index')}}" class="btn btn-light" style="margin-right: 50px;">Voltar</a>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </div>
</div>
@endsection
