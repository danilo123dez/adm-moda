<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait RequestTrait{

    public $guzzle = '';

    public function __construct(){
        $this->guzzle = new \GuzzleHttp\Client(['http_errors' => false,'base_uri' =>  getenv('API_URL')]);
    }

    public function sendDataLogin($email, $password){
       $http = new \GuzzleHttp\Client(['http_errors' => false,'base_uri' =>  getenv('OAUTH_URL') ]);
       $http = $http->request('POST','', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => getenv('CLIENT_ID_PASS'),
                'client_secret' => getenv('CLIENT_SECRET_PASS'),
                'username' => $email,
                'password' => $password
            ]
        ]);
        $body = json_decode($http->getBody()->getContents(), true);
        $status = $http->getStatusCode();
        return [
            'body' => $body,
            'status' => $status
        ];
    }

    public function accessTokensSpecifics($scope){
        $http = new \GuzzleHttp\Client(['http_errors' => false,'base_uri' =>  getenv('OAUTH_URL') ]);
        $http = $http->request('POST','', [
             'form_params' => [
                 'grant_type' => 'client_credentials',
                 'client_id' => getenv('CLIENT_ID'),
                 'client_secret' => getenv('CLIENT_SECRET'),
                 'scope' => (string)$scope
             ]
         ]);
         $body = json_decode($http->getBody()->getContents(), true);
         $status = $http->getStatusCode();
         return [
             'body' => $body,
             'status' => $status
         ];
    }

}
