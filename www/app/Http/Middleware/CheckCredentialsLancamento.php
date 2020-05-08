<?php

namespace App\Http\Middleware;

use App\Traits\RequestTrait;
use Closure;
use Illuminate\Support\Facades\Session;

class CheckCredentialsLancamento
{
    use RequestTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Session::has('access_token_lancamento')){
            $response_store = $this->accessTokensSpecifics('release');
            if($response_store['status'] !== 200){
                Session::flush();
                Session::save();
                return redirect()->route('login.index');
            }

            Session::put('access_token_lancamento', $response_store['body']['access_token']);
        }

        return $next($request);
    }
}
