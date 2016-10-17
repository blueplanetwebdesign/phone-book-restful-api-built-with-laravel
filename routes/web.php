<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use GuzzleHttp\Client;

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::get('/api-control-panel', 'ApiControlPanelController@index');

Route::post('/api-control-panel', 'ApiControlPanelController@store');


Route::get('/api-test/create', function () {

    $token = '$2y$10$5EqUEWMuIWcRkrIX.SZ4je/K0HLWrHNALFaoS.Od1EkLbFiL9VE0e';
    $client = new GuzzleHttp\Client;


    $response = $client->post('http://phone-book-api.app/api/v1/create/phone-book', [
        'headers' => [
            'Authorization' =>  'Bearer '.$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ],
        'form_params' => array(
            'email' => 'test@gmail.com',
            'name' => 'Test user',
            'password' => 'testpassword'
        ),
        'http_errors' => false
    ]);

    if($response->getStatusCode() == 200){
        echo 'Ok';
        print_r($response->getBody()->getContents());
    }
    else{
        echo 'Error code - '.$response->getStatusCode();
    }

});