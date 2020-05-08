<?php

namespace App\Http\Controllers;

use App\Http\Requests\LojaStoreRequest;
use App\Http\Requests\LojaUpdateRequest;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LojasController extends Controller
{
    use RequestTrait;

    public function index(){
        $customer_uuid = Session::get('customer')['uuid'];
        $lojas = json_decode($this->guzzle->request('GET',"lojas/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);

        return view('lojas.lojas', ['lojas' => $lojas['data']]);
    }

    public function viewNew(){
        return view('lojas.nova-loja');
    }

    public function store(LojaStoreRequest $request){
        $customer_uuid = Session::get('customer')['uuid'];
        $loja = json_decode($this->guzzle->request('POST',"lojas/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
            ],
            'form_params' => $request->validated()
        ])->getBody()->getContents(), true);

        return redirect()->route('loja.show', ['loja_uuid' => $loja['data']]);
    }

    public function show($loja_uuid){
        $customer_uuid = Session::get('customer')['uuid'];
        $loja = json_decode($this->guzzle->request('GET',"lojas/$customer_uuid/$loja_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);
        
        return view('lojas.show', ['loja' => $loja['data']]);
    }

    public function update($loja_uuid, LojaUpdateRequest $request){
        $customer_uuid = Session::get('customer')['uuid'];
        $loja = json_decode($this->guzzle->request('PUT',"lojas/$customer_uuid/$loja_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
            ],
            'form_params' => $request->validated()
        ])->getBody()->getContents(), true);
            
        return redirect()->route('loja.show', ['loja_uuid' => $loja_uuid]);
    }

    public function delete($loja_uuid){
        $customer_uuid = Session::get('customer')['uuid'];
        $loja = json_decode($this->guzzle->request('DELETE',"lojas/$customer_uuid/$loja_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_loja'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);
        
        return response($loja);
    }
}
