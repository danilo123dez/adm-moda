<?php

namespace App\Http\Controllers;

use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use RequestTrait;

    public function index(){
        return view('login');
    }

    public function login(Request $request){
        try{
            $response = $this->sendDataLogin($request->email, $request->password);
            
            if($response['status'] !== 200){
                session()->flash('login_failed', true);
                return redirect()->back()->withInput();
            }

            Session::put('logged', true);

            $user = json_decode($this->guzzle->request('GET','user', [
                'headers' => [
                    'Authorization' => "Bearer " . $response['body']['access_token'],
                    'Accept' => 'application/json'
                    ]
            ])->getBody()->getContents(), true);
            Session::put('customer', $user['data']);

            return redirect()->route('home');

        }catch(\Exception $e){
            Session::flush();
            Session::save();
            Log::error('[Error in login]', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            session()->flash('error_login', true);
            return redirect()->back()->withInput();
        }
    }
}
