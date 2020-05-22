@foreach($data['lancamentos'] as $lancamentos)
@php $i = 1; @endphp
@php $count = count($lancamentos); @endphp
@php $valor_total = 0; @endphp
@php $valor_comissao = 0; @endphp
    @foreach($lancamentos as $dados)
    @if($i === 1)

        <table>
            <tbody>
                <tr></tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="height: 30px;font-size: 30px;"> <strong> {{ $data['nome_empresa'] }} </strong></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                @foreach($data['admins'] as $adm)
                    <tr>
                        <td colspan="2"></td>
                        <td style="height: 24px;font-size: 24px;font-family: 'Times New Roman';"> <i> {{ $adm['nome'] }} - {{ $adm['numero'] }}</i></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2"></td>
                    <td style="height: 24px;font-size: 24px;font-family: 'Times New Roman';"> {{ $data['empresa']['email_empresa'] }} </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr></tr>
                <tr>
                    <th style="height: 16px;" colspan="2"></th>
                    <th style="height: 20px; text-align:center; padding-bottom:15px; background-color: #D1D1D1; border: 1px solid black;"> <strong> Loja: {{ $dados['nome_loja'] }} </strong> </th>
                    <th style="height: 20px; text-align:center; padding-bottom:15px; background-color: #D1D1D1; border: 1px solid black;"></th>
                </tr>
                <tr>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Boleta </strong> </th>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Romaneio </strong> </th>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Nome do Cliente </strong> </th>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Data da compra </strong> </th>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Data da Vencimento </strong> </th>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Valor </strong> </th>
                    <th style="height: 20px; text-align:center; background-color: #D1D1D1; border: 1px solid black;"> <strong> Comissão </strong> </th>
                </tr>
            </thead>
            <tbody>
    @endif
                <tr>
                    @php $valor_total += $dados['valor']; @endphp
                    @php $valor_comissao += $dados['valor'] * ($dados['comissao'] / 100); @endphp
                    <td  style="border: 1px solid black; height: 20px; text-align:center;">{{ $dados['boleta'] }}</td>
                    <td  style="border: 1px solid black; height: 20px; text-align:center;">{{ $dados['romaneio'] }}</td>
                    <td  style="border: 1px solid black; height: 20px; text-align:center; width: 32px;">{{ $dados['cliente'] }}</td>
                    <td  style="border: 1px solid black; height: 20px; text-align:center;">{{ $dados['data_compra'] }}</td>
                    <td  style="border: 1px solid black; height: 20px; text-align:center;">{{ $dados['data_vencimento'] }}</td>
                    <td  style="border: 1px solid black; height: 20px; text-align:center;">R${{ number_format($dados['valor'],2,",",".") }}</td>
                    <td  style="border: 1px solid black; height: 20px; text-align:center;">R${{ number_format($dados['valor'] * ($dados['comissao'] / 100),2,",",".") }}</td>
                </tr>
    @if($count === $i)
                <tr>

                </tr>
                <tr>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1;  border: 2px solid black;" colspan="2">Valor de Vendas</td>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1;" colspan="3"></td>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1;  border: 1px solid black;">R${{ number_format($valor_total,2,",",".") }}</td>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1;"></td>
                </tr>
                <tr>
                    <td style="height: 20px;" colspan="3"></td>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1; border: 2px solid black;">Valor Comissão</td>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1;" colspan="2"></td>
                    <td style="height: 20px; text-align:center; background-color: #D1D1D1;  border: 1px solid black;">R${{ number_format($valor_comissao,2,",",".") }}</td>
                </tr>
            </tbody>
        </table>
    @endif
        @php $i++; @endphp
    @endforeach
@endforeach

