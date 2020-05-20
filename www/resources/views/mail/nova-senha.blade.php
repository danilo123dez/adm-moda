@section('title', 'Recuperação de senha - Admin Moda')
@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="#">Administração de Moda</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">Cadastrar nova senha</p>
            <form action="{{ route('recover.pass', ['customer_uuid' => $customer_uuid]) }}" method="post" class="js--form-recover-pass">
                {{ csrf_field() }}
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

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control js--password"
                           placeholder="Senha" minlength="6">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3 js--div-confirm-pass">
                    <input type="password" name="confrm-pass" class="form-control js--confirm-pass"
                           placeholder="Confirmar Senha" minlength="6">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Alterar senha
                </button>
            </form>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('/js/recuperar-senha.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
