<?php

namespace App\Http\Controllers;

use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    use RequestTrait;

    public function index(){
        $customer_uuid = Session::get('customer')['uuid'];
        dd(Session::all());
        $lancamentos = json_decode($this->guzzle->request('GET',"lancamentos/$customer_uuid/semana", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
                ]
        ])->getBody()->getContents(), true);
        dd($lancamentos);
        return view('home', ['lancamentos' => $lancamentos['data']]);
    }
}
