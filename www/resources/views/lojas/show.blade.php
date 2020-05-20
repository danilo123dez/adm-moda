@extends('adminlte::page')
@section('title', 'Lojas - Admin Moda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Loja</h3>
    </div>
    <div class="card-body">
        <form class="needs-validation" action="{{route('loja.update', ['loja_uuid' => $loja['loja']['uuid'] ])}}"  method="POST">
            @method('PUT')
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
                    <input type="text" class="form-control" name="nome" placeholder="Nome da Loja" value="{{$loja['loja']['nome']}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-1">
                    <label for="validationCustom01">Comissão</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">%</span>
                        </div>
                        <input type="number" min="1" max="100" step="0.1" class="form-control" name="comissao" placeholder="Porcentagem de comissão" value="{{$loja['loja']['comissao']}}" aria-describedby="inputGroupPrepend" required>
                    </div>
                </div>
            </div>
            <a href="{{route('lojas.index')}}" class="btn btn-light" style="margin-right: 50px;">Voltar</a>
            <button class="btn btn-primary" type="submit">Editar</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Lançamentos desta Loja</h5>
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
                    <th>Ações</th>
                </thead>
                <tbody>

                    @foreach($loja['lancamentos'] as $lancamento)
                        <tr>
                            <td>{{$lancamento['boleta']}}</td>
                            <td>{{$lancamento['romaneio']}}</td>
                            <td>{{$lancamento['cliente']}}</td>
                            <td>{{$lancamento['data_compra']}}</td>
                            <td>{{$lancamento['data_vencimento']}}</td>
                            <td>R$ {{number_format($lancamento['valor'],2,",",".")}}</td>
                            <td class="acoes-lancamentos">
                                <a href="{{ route('lancamento.show', ['loja_uuid' => $loja['loja']['uuid'],'lancamento_uuid' => $lancamento['uuid']])}}"><i class="fas fa-edit"></i></a>
                                <a href="" class="js--lancamento-delete" data-link-delete="{{ route('lancamento.delete', ['loja_uuid' => $loja['loja']['uuid'], 'lancamento_uuid' => $lancamento['uuid'] ]) }}"> <i class="fas fa-trash-alt"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <input type="hidden" class="token" value="{{csrf_token()}}">
    </div>
</div>
@endsection
