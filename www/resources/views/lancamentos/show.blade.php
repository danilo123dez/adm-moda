@extends('adminlte::page')
@section('title', 'Lançamentos - Admin Moda')

@section('content')
<div class="card">
    <div class="card-body">
        <form class="needs-validation" action="{{route('lancamento.update', ['loja_uuid' => $lancamento['loja_uuid'], 'lancamento_uuid' => $lancamento['uuid']])}}" method="POST">
            @method('put')
            @csrf
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Boleta</label>
                    <input type="text" class="form-control" placeholder="Boleta" name="boleta" value="{{$lancamento['boleta']}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Romaneio</label>
                    <input type="text" class="form-control" placeholder="Romaneio" name="romaneio" value="{{$lancamento['romaneio']}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Data de Compra</label>
                    <input type="text" class="form-control" id="data_compra_store" placeholder="Data da Compra" name="data_compra" value="{{$lancamento['data_compra']}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Data de Vencimento</label>
                    <input type="text" class="form-control" id="data_vencimento_store" placeholder="Data de vencimento" name="data_vencimento" value="{{$lancamento['data_vencimento']}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Valor</label>
                    <input type="text" class="form-control js--valor" placeholder="Valor" name="valor" value="R${{number_format($lancamento['valor'],2,",",".")}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Comissão</label>
                    <input type="text" disabled class="form-control" placeholder="Comissão" value="R${{number_format($lancamento['valor'] * ($lancamento['loja_comissao']/100),2,",",".")}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Cliente</label>
                    <input type="text" class="form-control" placeholder="Nome do(a) Cliente" name="cliente" value="{{$lancamento['cliente']}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom03">Loja</label>
                    <div class="loja-selected-row">
                        <div class="loja-select-row">
                            <select id="lojas-disponiveis" style="width: 100%" name="loja" required>
                                @foreach($lojas as $loja)
                                    <option {{ $loja['uuid'] === $lancamento['loja_uuid'] ? 'selected' : '' }} value="{{$loja['uuid']}}">{{$loja['nome']}} - {{$loja['comissao']}}%</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="loja-link">
                            <a target="_blank" href="{{ route('loja.show', ['loja_uuid' => $lancamento['loja_uuid']]) }}"><i class="far fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('lancamentos.index')}}" class="btn btn-light" style="margin-right: 50px;">Voltar</a>
            <button class="btn btn-primary" type="submit">Editar</button>
        </form>
    </div>
</div>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('/js/build/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/lancamentos/lancamentos.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('/js/build/jquery.datetimepicker.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/build/mask-money.js') }}"></script>
    <script src="{{ asset('/js/lancamentos/novo-lancamento.js') }}"></script>
@endsection
