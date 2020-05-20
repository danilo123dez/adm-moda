
@extends('adminlte::page')
@section('title', 'Administradores - Admin Moda')

@section('content')
<div class="button-stored">
    <a href="{{route('novo.admin')}}" class="btn btn-primary">Cadastrar um novo Administrador</a>
</div>
    <div class="card">
        <div class="card-header">
            <h3>Administradores</h3>
        </div>
        <div class="card-body">
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
            <div class="table-responsive">
                <table class="table table-default js--lojas-index-table">
                    <thead>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr style="{{ session()->get('customer')['email'] === $admin['email'] ? 'background-color: #c3c3c3' : '' }}">
                                <td>{{ $admin['nome'] }}</td>
                                <td>{{ $admin['email'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
