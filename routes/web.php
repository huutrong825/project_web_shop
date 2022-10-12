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

Route::group(['middleware'=>'AdminLogin', 'prefix'=>'admin'],function(){

    Route::get('/',function(){
        return view('Admin/admin_index');
    });

    Route::get('/profile', ['uses'=>'AuthController@getProfile']);
    Route::get('/logout', ['uses'=>'AuthController@getLogout']);

    Route::group(['prefix'=>'user'],function(){
        Route::get('/',['uses'=>'UserManagerController@listAdmin']);

        Route::post('/',['uses'=>'UserManagerController@postAddUser']);
    });

});