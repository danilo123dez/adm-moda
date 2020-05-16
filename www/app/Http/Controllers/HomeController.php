<?php

namespace App\Http\Controllers;

use App\Exports\LancamentosExport;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    use RequestTrait;

    public function index(Request $request){
        $customer_uuid = Session::get('customer')['uuid'];

        !empty($request->download) && $request->download ? $query = ['download' => true] :  $query = [];

        $lancamentos = json_decode($this->guzzle->request('GET',"lancamentos/$customer_uuid/semana", [
            'headers' => [
                'Authorization' => "Bearer " . Session::get('access_token_lancamento'),
                'Accept' => 'application/json'
            ],
            'query' => $query
        ])->getBody()->getContents(), true);

        if(!empty($request->download) && $request->download){
            $data = [];
            $data['lancamentos'] = $lancamentos['data'];
            $data['nome_empresa'] = Session::get('customer')['nome_empresa'];

            $admins = json_decode($this->guzzle->request('GET',"customers/$customer_uuid/admin", [
                'headers' => [
                    'Authorization' => "Bearer " . Session::get('access_token_customer'),
                    'Accept' => 'application/json'
                    ]
            ])->getBody()->getContents(), true);
            $data['admins'] = $admins['data'];

            return Excel::download(new LancamentosExport($data), 'relatorio-'.date('m-Y').'.xlsx');
        }

        return view('home', ['lancamentos' => $lancamentos['data']]);
    }
}
