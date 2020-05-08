@extends('adminlte::page')
@section('title', 'Lançamentos - Admin Moda')

@section('content')
<div class="button-stored">
    <a href="{{route('lancamentos.viewnew')}}" class="btn btn-primary">Cadastrar Novo Lançamento</a>
</div>
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
            <th>Ações</th>
        </thead>
        <tbody>
            
            @foreach($lancamentos as $lancamento)
                <tr>
                    <td>{{$lancamento['boleta']}}</td>
                    <td>{{$lancamento['romaneio']}}</td>
                    <td>{{$lancamento['cliente']}}</td>
                    <td>{{$lancamento['data_compra']}}</td>
                    <td>{{$lancamento['data_vencimento']}}</td>
                    <td>R$ {{number_format($lancamento['valor'],2,",",".")}}</td>
                    <td><a href="{{route('loja.show',  ['loja_uuid' => $lancamento['loja_uuid']])}}">{{$lancamento['nome_loja']}}</a></td>
                    <td style="display: flex;justify-content: space-evenly;">
                        <a href="{{ route('lancamento.show', ['loja_uuid' => $lancamento['loja_uuid'],'lancamento_uuid' => $lancamento['uuid']])}}"><i class="fas fa-edit"></i></a>
                        <a href="" class="js--lancamento-delete" data-link-delete="{{ route('lancamento.delete', ['loja_uuid' => $lancamento['loja_uuid'], 'lancamento_uuid' => $lancamento['uuid'] ]) }}"> <i class="fas fa-trash-alt"></i> </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<input type="hidden" class="token" value="{{csrf_token()}}">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('/js/lancamentos/lancamentos.js') }}"></script>
@endsection