<?php

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

Route::get('/', ['uses' => 'AdController@index', 'as' => 'index']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/edit', ['uses' => 'AdController@showCreateForm', 'as' => 'showCreateForm']);
    Route::post('/edit', ['uses' => 'AdController@create', 'as' => 'create']);
    Route::get('/edit/{id}', ['uses' => 'AdController@showEditForm', 'as' => 'showEditForm']);
    Route::post('/edit/{id}', ['uses' => 'AdController@edit', 'as' => 'edit']);

    Route::get('/delete/{id}', ['uses' => 'AdController@delete', 'as' => 'delete']);
});

Route::get('/{id}', ['uses' => 'AdController@show', 'as' => 'show']);