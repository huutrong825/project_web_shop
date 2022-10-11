<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/login',['uses'=>'AuthController@getLogin']);
Route::post('/login',['uses'=>'AuthController@postLogin']);

Route::get('/register',['uses'=>'AuthController@getRegister']);
Route::post('/register',['uses'=>'AuthController@postRegister']);

Route::get('/logout',['uses'=>'AuthController@getLogout']);

Route::get('/admin',function(){
    return view('layout_admin');
});
