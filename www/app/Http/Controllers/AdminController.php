<?php

namespace App\Http\Controllers;

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
}
