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

Route::get('/', function () {
    return view('admin');
});

Route::group([
    'prefix' => 'users'
], function () {
    Route::get('/', 'UserController@store');
    Route::get('/search', 'UserController@search');
    Route::get('/edit/{id}', 'UserController@edit')
        ->where('id', '[0-9]+');
    Route::get('/info/{id}', 'UserController@info')
        ->where('id', '[0-9]+');
    Route::post('/create', 'UserController@create');
    Route::post('/update/{id}', 'UserController@update')
        ->where('id', '[0-9]+');
    Route::post('/remove/{id}', 'UserController@destroy')
        ->where('id', '[0-9]+');
});