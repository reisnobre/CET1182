<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('/user', 'UsersController@show');
    Route::get('/users', 'UsersController@index');
    Route::get('/auth-request', function () { return response(['status' => true], 200); });
});


Route::group(['prefix' => 'v1', 'middleware' => ['auth:api', 'role'], 'role' => 'admin'], function () {

    /*
    * - Capacidades de um administrador
    * - Operações de CRUD em super usuários via interface gráfica (ig)
    * - Vizualizar todos os usuários e suas categorias, existentes no sistema via (ig)
    * - Adicionalmente tudo que um super usuário é capaz de fazer
    */

    Route::post('/create-users', 'UsersController@store');

    Route::get('/roles', 'RolesController@index');
    Route::get('/user/{id}', 'UsersController@show');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:api', 'role'], 'role' => 'sudo'], function () {
    /*
    * Capacidades de um Super usuário (sudo)
    * - Operações de CRUD em eventos que ele tenha criado
    * - Registro de participantes no evento com diferentes categorias => staff e organização...
    * - Emissão de certificados em massa, a serem enviados por email no formato de email
    * - Exportação de documentos => lista de inscritos...
    * - Vizualizar todos os usuários inscritos em um dado evento pertecente ao usuário
    * - Adicionalmente tudo que um super usuário é capaz de fazer
    */

    Route::get('/footer/{id}', 'FooterImagesController@show');
    Route::get('/footers', 'FooterImagesController@index');
    Route::get('/genres', 'GenreController@index');
    Route::get('/inscription/{id}', 'InscriptionsController@show');
    Route::post('/inscription/{id}', 'InscriptionsController@update');
    Route::get('/inscriptions', 'InscriptionsController@index');
    Route::get('/p-event/{id}', 'EventsController@privateShow');
    Route::get('/p-events', 'EventsController@privateIndex');
    Route::get('/template/{id}', 'TemplatesController@show');
    Route::get('/templates', 'TemplatesController@index');
    Route::post('/events', 'EventsController@store');
    Route::post('/footers', 'FooterImagesController@store');
    Route::post('/templates', 'TemplatesController@store');
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/events', 'EventsController@index');
    Route::get('/event/{id}', 'EventsController@show');
    Route::get('/bonds', 'BondsController@index');
    Route::post('/register', 'UsersController@store');
    Route::post('/inscriptions', 'InscriptionsController@store');
});
// Rotas externas
