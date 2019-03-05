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

Route::group(['prefix' => '/inicio', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'InitController@index'));
});

Route::group(['prefix' => '/importar', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'ImportController@index'));
    Route::post('/planilha', array('uses' => 'ImportController@importPlan'));
    Route::post('/planilha/save', array('uses' => 'ImportController@save'));
});

Route::group(['prefix' => '/distribuir', 'middleware' => 'auth'], function () {
    Route::get('', array('uses' => 'DistributeController@index'));
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

Route::group(['prefix' => 'remessa', 'middleware' => 'auth'], function () {
    Route::get('/lista', ['uses' => 'DeliveryController@lista']);
    Route::get('/delete/{id}', ['uses' => 'DeliveryController@destroy']);
    Route::get('/editar/{id}', ['uses' => 'DeliveryController@edit']);
    Route::post('/update', ['uses' => 'DeliveryController@update']);
});