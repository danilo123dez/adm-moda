<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    use RequestTrait;

    public function index(){
        $customer_uuid = Session::get('customer')['uuid'];
        $admins = json_decode($this->guzzle->request('GET',"customers/$customer_uuid/admin", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_customer'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);
        return view('admin.admin', ['admins' => $admins['data']] );
    }

    public function viewNew(){
        return view('admin.novo-admin');
    }

    public function store(CustomerStoreRequest $request){
        try{
            $inputs_validated = $request->validated();
            $inputs_validated['customer_uuid'] = Session::get('customer')['uuid'];
            $customer = json_decode($this->guzzle->request('POST',"customers/", [
                'headers' => [
                    'Authorization' => "Bearer " . Session::get('access_token_customer'),
                    'Accept' => 'application/json'
                ],
                'form_params' => $inputs_validated
            ])->getBody()->getContents(), true);
            if($customer['error'] === 1){
                session()->flash('error', $customer['description']);
                return redirect()->route('novo.admin')->withInput($request->input());
            }
            session()->flash('success', 'Administrador Cadastrado com sucesso');
            return redirect()->route('admin.index');
        }catch(\Exception $e){
            session()->flash('error', 'Houve um erro inesperado');
            return redirect()->route('novo.admin')->withInput($request->input());
        }
    }
}
