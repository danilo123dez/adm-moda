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
        $info_conta = Session::get('customer');
        return view('minha-conta.minha-conta', ['info_conta' => $info_conta]);
    }

    public function update($customer_uuid, CustomerUpdateRequest $request){

        $customer = json_decode($this->guzzle->request('PUT',"customers/$customer_uuid", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_customer'),
                'Accept' => 'application/json'
            ],
            'form_params' => $request->validated()
        ])->getBody()->getContents(), true);

        Session::put('customer', $customer['data']);
        return redirect()->route('minha.conta.index');
    }
}
