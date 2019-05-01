<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/teste', function (){
    return view('teste');
});

Route::get('/', array('uses' => 'UserController@index'));
Route::get ('/login', array('uses' => 'UserController@index'));
Route::post('/login', array('uses' => 'UserController@attemptLogin'));
Route::get('/logout', array('uses' => 'UserController@logout'));

Route::group(['prefix' => '/inicio', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'InitController@index'));
    Route::get('/user-prod/{month}/{year}', array('uses' => 'InitController@getReportByUsers'));
});

Route::group(['prefix' => '/adicionar', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'ImportController@index'));
    Route::post('', array('uses' => 'ImportController@importPlan'));
    Route::get('/planilha', ['uses' => 'ImportController@showPlan']);
    Route::get('/formatar-enderecos/{idDelivery}', ['uses' => 'ImportController@formatAddress']);
    Route::post('/planilha/save', array('uses' => 'ImportController@save'));
    Route::post('/salvar-manual', array('uses' => 'ImportController@saveManually'));
});

Route::group(['prefix' => '/distribuir', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'DistributeController@index'));
    Route::post('criar-rota', array('uses' => 'DistributeController@createRoute'));
});

Route::group(['prefix' => '/finalizar', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'FinalizeController@index'));
});

Route::group(['prefix' => '/administrar-campos', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'AdminFieldsController@index'));
});


Route::group(['prefix' => 'empresa', 'middleware' => 'auth'], function () {
    Route::get('/add', ['uses' => 'CompaniesController@add']);
    Route::get('/lista', ['uses' => 'CompaniesController@lista']);
    Route::post('/create', ['uses' => 'CompaniesController@store']);
    Route::get('/delete/{id}', ['uses' => 'CompaniesController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'CompaniesController@edit']);
    Route::post('/update', ['uses' => 'CompaniesController@update']);
});

Route::group(['prefix' => 'tipo-de-servico', 'middleware' => 'auth'], function () {
    Route::get('/add', ['uses' => 'ServiceTypeController@add']);
    Route::get('/lista', ['uses' => 'ServiceTypeController@lista']);
    Route::post('/create', ['uses' => 'ServiceTypeController@store']);
    Route::get('/delete/{id}', ['uses' => 'ServiceTypeController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'ServiceTypeController@edit']);
    Route::post('/update', ['uses' => 'ServiceTypeController@update']);
});

Route::group(['prefix' => 'polo', 'middleware' => 'auth'], function () {
    Route::get('/add', ['uses' => 'PoloController@add']);
    Route::get('/lista', ['uses' => 'PoloController@lista']);
    Route::post('/create', ['uses' => 'PoloController@store']);
    Route::get('/delete/{id}', ['uses' => 'PoloController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'PoloController@edit']);
    Route::post('/update', ['uses' => 'PoloController@update']);
});

Route::group(['prefix' => 'solicitante', 'middleware' => 'auth'], function () {
    Route::get('/add', ['uses' => 'ApplicantsController@add']);
    Route::get('/lista', ['uses' => 'ApplicantsController@lista']);
    Route::post('/create', ['uses' => 'ApplicantsController@store']);
    Route::get('/delete/{id}', ['uses' => 'ApplicantsController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'ApplicantsController@edit']);
    Route::post('/update', ['uses' => 'ApplicantsController@update']);
});

Route::group(['prefix' => 'usuarios', 'middleware' => 'auth'], function () {
    Route::get('/add', ['uses' => 'UserController@add']);
    Route::get('/lista', ['uses' => 'UserController@lista']);
    Route::post('/create', ['uses' => 'UserController@store']);
    Route::get('/delete/{id}', ['uses' => 'UserController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'UserController@edit']);
    Route::post('/update', ['uses' => 'UserController@update']);
});

Route::group(['prefix' => 'relatorios', 'middleware' => 'auth'], function () {
    Route::get('/add', ['uses' => 'ReportController@add']);
    Route::get('/lista', ['uses' => 'ReportController@lista']);
    Route::post('/create', ['uses' => 'ReportController@store']);
    Route::get('/delete/{id}', ['uses' => 'ReportController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'ReportController@edit']);
    Route::post('/update', ['uses' => 'ReportController@update']);
});

Route::group(['prefix' => 'remessa', 'middleware' => 'auth'], function () {
    Route::get('/lista', ['uses' => 'DeliveryController@lista']);
    Route::get('/delete/{id}', ['uses' => 'DeliveryController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'DeliveryController@edit']);
    Route::post('/update', ['uses' => 'DeliveryController@update']);
});

Route::group(['prefix' => 'servicos', 'middleware' => 'auth'], function () {
    Route::get('', ['uses' => 'ServicesController@index']);
    Route::get('/get-table', array('uses' => 'ServicesController@getTable'));
    Route::get('/{id}', ['uses' => 'ServicesController@details']);
    Route::get('/lista-por-remessa/{id}', ['uses' => 'ServicesController@listServicesByDelivery']);
    Route::post('/update', ['uses' => 'ServicesController@update']);
    Route::get('/imprimir/{id}', ['uses' => 'ServicesController@printOne']);
    Route::post('/imprimir', ['uses' => 'ReportController@printMany']);
});

Route::group(['prefix' => 'geolocalizacao', 'middleware' => 'auth'], function () {
    Route::get('', ['uses' => 'GeolocationController@index']);
    Route::post('/save-formated', array('uses' => 'GeolocationController@saveFormated'));
});

Route::group(['prefix' => 'mapa'], function () {
    Route::get('/servicos', array('uses' => 'ServicesController@map'));
});

Route::group(['prefix' => 'api'], function () {
    Route::post('/end-service', array('uses' => 'FinalizeController@endService'));
    Route::post('/save-address', array('uses' => 'WSController@saveAddress'));
});




