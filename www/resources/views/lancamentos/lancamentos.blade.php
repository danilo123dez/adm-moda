@extends('adminlte::page')
@section('title', 'Lançamentos - Admin Moda')

@section('content')
<div class="button-stored">
    <a href="{{route('lancamentos.viewnew')}}" class="btn btn-primary">Cadastrar Novo Lançamento</a>
</div>
<div class="card">
    <div class="card-header">
        <h3>Lançamentos</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('lancamentos.search') }}" method="POST" class="js--form-lancamento-pesquisa">
            @csrf
            <div class="itens-pesquisa">
                <div class="input-pesquisa">
                    <label class="label-inputs-lancamentos">Tipo Pesquisa</label> &nbsp;
                    <select class="form-control js--tipo-pesquisa select-lancamentos" name="tipo_pesquisa">
                        @foreach($tipos_pesquisa as $index => $pesquisa)
                            <option {{ !empty($arr_pesquisa['tipo_pesquisa']) && $arr_pesquisa['tipo_pesquisa'] === $index ? 'selected' : '' }} value="{{ $index }}">{{ $pesquisa }}</option>
                        @endforeach
                    </select>
                    <div class="js--pesquisa-texto inputs-pesquisa">
                        <label class="label-inputs-lancamentos">Pesquisa:</label>&nbsp;
                        <input value="{{ !empty($arr_pesquisa['pesquisa_texto']) ? $arr_pesquisa['pesquisa_texto'] : '' }}" class="form-control js--input-pesquisa-texto input-pesquisa-lancamentos" name="pesquisa_texto" type="text">
                    </div>
                    <div class="js--pesquisa-data inputs-pesquisa">
                        <div class="inputs-data">
                            <label class="label-inputs-lancamentos">Data de início:</label>&nbsp;
                            <input value="{{ !empty($arr_pesquisa['pesquisa_data_inicio']) ? $arr_pesquisa['pesquisa_data_inicio'] : '' }}" class="form-control js--pesquisa-data-inicio input-pesquisa-data-lancamento" name="pesquisa_data_inicio" type="text">
                        </div>
                        <div class="inputs-data">
                            <label class="label-inputs-lancamentos">Data de fim:</label>&nbsp;
                            <input value="{{ !empty($arr_pesquisa['pesquisa_data_fim']) ? $arr_pesquisa['pesquisa_data_fim'] : '' }}" class="form-control js--pesquisa-data-fim input-pesquisa-data-lancamento" name="pesquisa_data_fim" type="text">
                        </div>
                    </div>
                </div>
                <div class="lancamentos-vencidos">
                    <span>
                        Mostrar Lançamentos Vencidos
                    </span>
                    <div>
                        <input type="radio" name="exibe_lancamento_vencido" value="S" {{ !empty($arr_pesquisa['exibe_lancamento_vencido']) && $arr_pesquisa['exibe_lancamento_vencido'] === 'S' ? 'checked' : '' }}>
                        <span>Sim</span>

                        <input type="radio" name="exibe_lancamento_vencido" value="N" {{ !isset($arr_pesquisa['exibe_lancamento_vencido']) || $arr_pesquisa['exibe_lancamento_vencido'] === 'N' ? 'checked' : '' }}>
                        <span>Não</span>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary button-pesquisa"><i class="fas fa-search"></i></button>
                </div>
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
                            <td class="acoes-lancamentos">
                                <a href="{{ route('lancamento.show', ['loja_uuid' => $lancamento['loja_uuid'],'lancamento_uuid' => $lancamento['uuid']])}}"><i class="fas fa-edit"></i></a>
                                <a href="" class="js--lancamento-delete" data-link-delete="{{ route('lancamento.delete', ['loja_uuid' => $lancamento['loja_uuid'], 'lancamento_uuid' => $lancamento['uuid'] ]) }}"> <i class="fas fa-trash-alt"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="info-lancamento">
                    <div class="botao-imprimir">
                        <button type="submit" class="btn btn-primary imprimir-lancamento js--imprimir-lancamentos">Imprimir</button>
                    </div>
                </div>
        </form>
    </div>
</div>
<input type="hidden" class="token" value="{{csrf_token()}}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/js/build/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/lancamentos/lancamentos.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('/js/build/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('/js/lancamentos/lancamentos.js') }}"></script>
@endsection
