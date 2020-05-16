
@extends('adminlte::page')
@section('title', 'Home - Admin Moda')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Lançamentos para esta semana</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-default js--lancamentos-index-table">
                <thead>
                    <th>Boleta</th>
                    <th>Romaneio</th>
                    <th>Nome do Cliente</th>
                    <th>Data da compra</th>
                    <th>Data da Vencimento</th>
                    <th>Valor</th>
                    <th>Nome da Loja</th>
                </thead>
                <tbody>
                    @if(!empty($lancamentos))
                    @php
                        $total_compra = 0;
                        $total_comissao = 0;
                    @endphp
                        @foreach($lancamentos as $lancamento)
                            <tr>
                                <td>{{$lancamento['boleta']}}</td>
                                <td>{{$lancamento['romaneio']}}</td>
                                <td>{{$lancamento['cliente']}}</td>
                                <td>{{$lancamento['data_compra']}}</td>
                                <td>{{$lancamento['data_vencimento']}}</td>
                                <td>R$ {{number_format($lancamento['valor'],2,",",".")}}</td>
                                <td><a href="{{route('loja.show',  ['loja_uuid' => $lancamento['loja_uuid']])}}">{{$lancamento['nome_loja']}}</a></td>
                            </tr>
                            @php
                                $total_compra += $lancamento['valor'];
                                $total_comissao += $lancamento['valor'] * ($lancamento['loja_comissao']/100);
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @if(!empty($lancamentos))
            <div class="info-lancamento">
                <div class="botao-imprimir">
                    <a href="{{ route('home') }}?download=true" class="btn btn-primary imprimir-lancamento">Imprimir</a>
                </div>
                <div class="info-faturamento">
                    <span>
                        Total de compra: <strong>R${{ number_format($total_compra,2,",",".") }}</strong>
                    </span>
                    <span>
                        Total de comissão: <strong>R${{ number_format($total_comissao,2,",",".") }}</strong>
                    </span>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('/js/home.js') }}"></script>
@endsection
