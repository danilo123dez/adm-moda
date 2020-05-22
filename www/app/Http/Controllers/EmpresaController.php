<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Traits\RequestTrait;

class EmpresaController extends Controller
{
    use RequestTrait;

    public function index(){
        $customer_uuid = Session::get('customer')['uuid'];
        $empresa = json_decode($this->guzzle->request('GET',"enterprise/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_customer'),
                'Accept' => 'application/json'
            ]
        ])->getBody()->getContents(), true);

        return view('empresa.empresa', ['empresa' => $empresa['data']]);
    }

    public function update(Request $request){
        try{
            $data_send = [];
            $data_send['nome'] = $request->nome;
            $data_send['nome_empresa'] = $request->nome_empresa;
            $customer_uuid = Session::get('customer')['uuid'];
            $empresa = json_decode($this->guzzle->request('PUT',"enterprise/$customer_uuid", [
                'headers' => [
                    'Authorization' => "Bearer " . Session::get('access_token_customer'),
                    'Accept' => 'application/json'
                ],
                'form_params' => $data_send
            ])->getBody()->getContents(), true);

            if($empresa['error'] === 1){
                session()->flash('error', $empresa['description']);
            }

            $itens = Session::get('customer');
            $itens['nome_empresa'] = $empresa['data']['nome_empresa'];
            Session::put('customer', $itens);
            return redirect()->route('empresa.index');
        }catch(\Exception $e){
            session()->flash('error', 'Houve um erro inesperado');
            return redirect()->route('empresa.index');
        }
    }
}
