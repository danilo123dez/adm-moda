
@extends('adminlte::page')
@section('title', 'Home - Admin Moda')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-default js--lojas-index-table">
                    <thead>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
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
