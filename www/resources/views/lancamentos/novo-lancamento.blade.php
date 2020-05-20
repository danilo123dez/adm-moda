@extends('adminlte::page')
@section('title', 'Lançamentos - Admin Moda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Novo Lançamento</h3>
    </div>
    <div class="card-body">
        <form class="js--form-store-lancamento" action="{{route('lancamentos.store')}}" method="POST">
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
                    <label for="validationCustom03">Boleta</label>
                    <input type="text" class="form-control" placeholder="boleta" name="boleta" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Romaneio</label>
                    <input type="text" class="form-control" placeholder="romaneio" name="romaneio" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Data de Compra</label>
                    <input type="text" class="form-control" placeholder="Data da compra" readonly id="data_compra_store" name="data_compra" required>
                </div>
                <div class="col-md-4 mb-3 js--div-data-vencimento">
                    <label for="validationCustom03">Data de Vencimento</label>
                    <input type="text" class="form-control data_vencimento_store" readonly placeholder="Data de vencimento" id="data_vencimento_store" name="data_vencimento" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Valor</label>
                    <input type="text" class="form-control js--valor" placeholder="Valor" name="valor" maxlength="13" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Cliente</label>
                    <input type="text" class="form-control" placeholder="Cliente" name="cliente" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Loja</label>
                    <select id="lojas-disponiveis" style="width: 100%" name="loja" required>
                            <option value="">Selecione uma Loja</option>
                        @foreach($lojas as $loja)
                            <option value="{{$loja['uuid']}}">{{$loja['nome']}} - {{$loja['comissao']}}%</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <a href="{{route('lancamentos.index')}}" class="btn btn-light" style="margin-right: 50px;">Voltar</a>
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/build/mask-money.js') }}"></script>
    <script src="{{ asset('/js/lancamentos/novo-lancamento.js') }}"></script>
@endsection
