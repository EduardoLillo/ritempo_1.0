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
Route::get('/home','HomeController@index');



Route::get('/', function () {
    return view('auth/login');
});
Route::auth();

Route::resource('categoria','CategoriaController');

Route::resource('subcategoria','SubcategoriaController');

Route::resource('producto','ProductoController');

Route::resource('imagen','ImagenController');
*/



//rutas accessibles slo si el usuario no se ha logueado
Route::group(['middleware' => 'guest'], function () {

	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']); 
	// Registration routes...
	Route::get('register', 'Auth\AuthController@getRegister');
	Route::post('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);
});

//rutas accessibles solo si el usuario esta autenticado y ha ingresado al sistema
Route::group(['middleware' => 'auth'], function () {

	Route::get('/', 'CategoriaController@index');
	Route::get('home', 'CategoriaController@index'); 
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

	Route::resource('categoria','CategoriaController');
	Route::resource('subcategoria','SubcategoriaController');

	Route::resource('producto','ProductoController');

	Route::resource('imagen','ImagenController');
});
