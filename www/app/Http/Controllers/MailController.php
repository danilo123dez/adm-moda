<?php

namespace App\Http\Controllers;

use App\Mail\esqueciMinhaSenha;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MailController extends Controller
{
    use RequestTrait;

    public function forgetPassword(){
        return view('mail.esqueci-minha-senha');
    }

    public function sendMailPassword(Request $request){
        try{
            $customer = json_decode($this->guzzle->request('GET', 'customer', [
                'query' => ['email' => $request->email]
            ])->getBody()->getContents(), true);

            if($customer['error'] === 1){
                session()->flash('error', $customer['description']);
                return redirect()->route('view.mail.pass')->withInput($request->input());
            }

            $url_recover = URL::temporarySignedRoute('recover.pass', now()->addHours(3), ['customer_uuid' => $customer['data']['uuid']]);
            $customer['data']['url'] = $url_recover;
            Mail::to($request->email)->send(new esqueciMinhaSenha($customer['data']));

            session()->flash('success', 'E-mail enviado com sucesso. Ele é válido por 3 horas!');
            return redirect()->route('view.mail.pass');

        }catch(\Exception $e){
            session()->flash('error', 'Ocorreu um erro inesperado');
            return redirect()->route('view.mail.pass')->withInput($request->input());
        }
    }

    public function viewRecoverPassword($customer_uuid, Request $request){
        if (! $request->hasValidSignature()) {
            session()->flash('error', 'Este link já foi expirado, enviamos outro e-mail!');
            $customer = json_decode($this->guzzle->request('GET', 'customer', [
                'query' => ['uuid' => $customer_uuid]
            ])->getBody()->getContents(), true);

            $url_recover = URL::temporarySignedRoute('recover.pass', now()->addHours(3), ['customer_uuid' => $customer['data']['uuid']]);
            $customer['data']['url'] = $url_recover;
            Mail::to($customer['data']['email'])->send(new esqueciMinhaSenha($customer['data']));
            return redirect()->route('login.index');
        }
        return view('mail.nova-senha', ['customer_uuid' => $customer_uuid]);
    }

    public function recoverPassword($customer_uuid, Request $request){
        try{
            $customer = json_decode($this->guzzle->request('POST', "customer/$customer_uuid/update-pass", [
                'form_params' => ['password' => $request->password]
            ])->getBody()->getContents(), true);

            if($customer['error'] === 1){
                session()->flash('error', $customer['description']);
                return redirect()->route('view.recover.pass');
            }

            session()->flash('success', 'Senha alterada com sucesso');
            return redirect()->route('login.index');

        }catch(\Exception $e){
            session()->flash('error', 'Ocorreu um erro inesperado');
            return redirect()->route('view.recover.pass');
        }
    }
}
