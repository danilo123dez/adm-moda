<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Traits\RequestTrait;
class CustomerController extends Controller
{
    use RequestTrait;

    public function index(){

        $customer = json_decode($this->guzzle->request('GET', 'customer', [
            'query' => ['uuid' => Session::get('customer')['uuid']]
        ])->getBody()->getContents(), true);

        return view('minha-conta.minha-conta', ['info_conta' => $customer['data']]);
    }

    public function update($customer_uuid, CustomerUpdateRequest $request){
        $validated = $request->validated();
        $validated['cpf'] = str_replace('.', '', $validated['cpf']);
        $validated['cpf'] = str_replace('-', '', $validated['cpf']);
        $validated['numero'] = str_replace('(', '', $validated['numero']);
        $validated['numero'] = str_replace(')', '', $validated['numero']);
        $validated['numero'] = str_replace(' ', '', $validated['numero']);
        $validated['numero'] = str_replace('-', '', $validated['numero']);

        $customer = json_decode($this->guzzle->request('PUT',"customers/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_customer'),
                'Accept' => 'application/json'
            ],
            'form_params' => $validated
        ])->getBody()->getContents(), true);

        if($customer['error'] === 1){
            session()->flash('error', $customer['description']);
            return redirect()->route('minha.conta.index');
        }

        Session::put('customer', $customer['data']);
        return redirect()->route('minha.conta.index');
    }
}
