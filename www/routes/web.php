<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@login')->name('login.login');;
Route::get('/sair', function(){
    Session::flush();
    Session::save();
    return redirect()->route('login.index');
});

Route::group(['middleware' => ['auth.custom', 'checkCredentials.Loja', 'checkCredentials.Lancamento', 'checkCredentials.Customer']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'minha-conta'], function () {
        Route::get('/', 'CustomerController@index')->name('minha.conta.index');
        Route::group(['prefix' => '{customer_uuid}'], function () {
            Route::put('/', 'CustomerController@update')->name('minha.conta.update');
        });
    });

    Route::group(['prefix' => 'administradores'], function () {
        Route::get('/', 'AdminController@index');
    });

    Route::group(['prefix' => 'lojas'], function () {
        Route::get('/', 'LojasController@index')->name('lojas.index');
        Route::get('/nova-loja', 'LojasController@viewNew')->name('lojas.viewnew');
        Route::post('/nova-loja', 'LojasController@store')->name('lojas.store');
        Route::group(['prefix' => '{loja_uuid}'], function () {
            Route::put('/', 'LojasController@update')->name('loja.update');
            Route::get('/', 'LojasController@show')->name('loja.show');
            Route::delete('/', 'LojasController@delete')->name('loja.delete');
        });
    });

    Route::group(['prefix' => 'lancamentos'], function () {
        Route::get('/', 'LancamentosController@index')->name('lancamentos.index');
        Route::get('/novo-lancamento', 'LancamentosController@viewNew')->name('lancamentos.viewnew');
        Route::post('/novo-lancamento', 'LancamentosController@store')->name('lancamentos.store');
        Route::group(['prefix' => '{loja_uuid}'], function () {
            Route::group(['prefix' => '{lancamento_uuid}'], function () {
                Route::get('/', 'LancamentosController@show')->name('lancamento.show');
                Route::put('/', 'LancamentosController@update')->name('lancamento.update');
                Route::delete('/', 'LancamentosController@delete')->name('lancamento.delete');
            });
        });
    });
});
