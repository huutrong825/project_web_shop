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

        // Route::get('/add',['uses'=>'UserManagerController@getAddUser']);
        Route::post('/add',['uses'=>'UserManagerController@postAddUser']);

        Route::get('/delete/{id}',['uses'=>'UserManagerController@deleteUser']);

        Route::get('/block/{id}',['uses'=>'UserManagerController@blockUser']);

        Route::get('/fix/{id}',['uses'=>'UserManagerController@getFixUser']);
        Route::post('/fix/{id}',['uses'=>'UserManagerController@postFixUser']);

        Route::get('/search',['uses'=>'UserManagerController@search']);
    });

});