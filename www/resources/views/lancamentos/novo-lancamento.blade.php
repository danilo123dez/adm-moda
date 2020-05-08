@extends('adminlte::page')
@section('title', 'Lançamentos - Admin Moda')

@section('content')
<div class="card">
    <div class="card-body">
        <form class="needs-validation" action="{{route('lancamentos.store')}}" method="POST">
            @csrf
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
                    <input type="text" class="form-control" placeholder="Data da compra" id="data_compra_store" name="data_compra" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Data de Vencimento</label>
                    <input type="text" class="form-control" placeholder="Data de vencimento" id="data_vencimento_store" name="data_vencimento" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Valor</label>
                    <input type="text" class="form-control js--valor" placeholder="Valor" name="valor" required>
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
    <link rel="stylesheet" href="{{ asset('/js/build/jquery.datetimepicker.min.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('/js/build/jquery.datetimepicker.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/build/mask-money.js') }}"></script>
    <script src="{{ asset('/js/lancamentos/novo-lancamento.js') }}"></script>
@endsection