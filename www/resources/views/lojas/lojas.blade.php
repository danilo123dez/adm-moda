@extends('adminlte::page')
@section('title', 'Lojas - Admin Moda')

@section('content')
<div class="button-stored">
    <a href="{{route('lojas.viewnew')}}" class="btn btn-primary">Cadastrar Nova Loja</a>
</div>
<div class="card">
    <div class="card-header">
        <h3>Lojas</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-default js--lojas-index-table">
                <thead>
                    <th>Nome</th>
                    <th>Comissão</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                    @foreach($lojas as $loja)
                        <tr>
                            <td>{{$loja['nome']}}</td>
                            <td>{{$loja['comissao']}} %</td>
                            <td style="display: flex;justify-content: space-evenly;">
                                <a href="{{route('loja.show', ['loja_uuid' => $loja['uuid']])}}"><i class="fas fa-edit"></i></a>
                                <a href="#" class="js--loja-delete" data-link-delete="{{ route('loja.delete', ['loja_uuid' => $loja['uuid']]) }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" class="token" value="{{csrf_token()}}">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('/js/lojas/lojas.js') }}"></script>
@endsection
