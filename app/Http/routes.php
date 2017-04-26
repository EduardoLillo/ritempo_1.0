<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|Route::resource('categoria','CategoriaController');
Route::get('categoria/create','CategoriaController@create');
Route::get('categoria','CategoriaController@index');
Route::get('categoria/store','CategoriaController@sotore');
Route::get('categoria/show','CategoriaController@show');
Route::get('categoria/edit','CategoriaController@edit');
Route::get('categoria/update','CategoriaController@update');
Route::get('categoria/destroy','CategoriaController@destroy');
Route::get('categoria/create','CategoriaController');
Route::resource('subcategoria/create','CategoriaController');
Route::get('subcategoria.create', ['as' => 'create', 'uses' => 'SubcategoriaController@create']);
Route::get('subcategoria.create','SubcategoriaController@create');
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('categoria','CategoriaController');

Route::resource('subcategoria','SubcategoriaController');

Route::resource('producto','ProductoController');

Route::resource('imagen','ImagenController');

