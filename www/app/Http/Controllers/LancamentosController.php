<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use App\Http\Requests\LancamentoStore;
use Illuminate\Support\Facades\Session;

class LancamentosController extends Controller
{
    use RequestTrait;
    public function index(){
        $customer_uuid = Session::get('customer')['uuid'];
        $lancamentos = json_decode($this->guzzle->request('GET',"lancamentos/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);
        
        return view('lancamentos.lancamentos', ['lancamentos' => $lancamentos['data']]);
    }

    public function viewNew(){
        $customer_uuid = Session::get('customer')['uuid'];
        $lojas = json_decode($this->guzzle->request('GET',"lojas/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);

        return view('lancamentos.novo-lancamento', ['lojas' => $lojas['data']]);
    }

    public function  store(LancamentoStore $request){
        $customer_uuid = Session::get('customer')['uuid'];
        $inputs_validated = $request->validated();
        $uuid_loja = $inputs_validated['loja'];
        unset($inputs_validated['loja']);

        $valor = explode('$',$inputs_validated['valor'])[1];
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $inputs_validated['valor'] = $valor;

        $store_lancamento = json_decode($this->guzzle->request('POST',"lancamentos/$customer_uuid/$uuid_loja", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
            ],
            'form_params' => $inputs_validated
        ])->getBody()->getContents(), true);

        return redirect()->route('lancamento.show', ['loja_uuid' => $uuid_loja, 'lancamento_uuid' => $store_lancamento['data']]);
    }

    public function show($loja_uuid, $lancamentos_uuid){
        $customer_uuid = Session::get('customer')['uuid'];
        $lancamento = json_decode($this->guzzle->request('GET',"lancamentos/$customer_uuid/$loja_uuid/$lancamentos_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);

        $lojas = json_decode($this->guzzle->request('GET',"lojas/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);

        return view('lancamentos.show', ['lancamento' => $lancamento['data'], 'lojas' => $lojas['data']]);
    }

    public function update($loja_uuid, $lancamento_uuid, LancamentoStore $request){
        $customer_uuid = Session::get('customer')['uuid'];
        $inputs_validated = $request->validated();

        $valor = explode('$',$inputs_validated['valor'])[1];
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $inputs_validated['valor'] = (float)$valor;
        
        $lancamento = json_decode($this->guzzle->request('PUT',"lancamentos/$customer_uuid/$loja_uuid/$lancamento_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
            ],
            'form_params' => $inputs_validated
        ])->getBody()->getContents(), true);
            
        return redirect()->route('lancamento.show', ['loja_uuid' => $inputs_validated['loja'], 'lancamento_uuid' => $lancamento_uuid]);
    }

    public function delete($loja_uuid, $lancamentos_uuid, Request $request){
        $customer_uuid = Session::get('customer')['uuid'];
        $lancamento = json_decode($this->guzzle->request('DELETE',"lancamentos/$customer_uuid/$loja_uuid/$lancamentos_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);

        return response($lancamento);
    }
}
