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
    Route::post('/profile', ['uses'=>'AuthController@updateProfile']);

    Route::get('/logout', ['uses'=>'AuthController@getLogout']);

    Route::group(['prefix'=>'user'],function(){
        Route::get('/',['uses'=>'UserManagerController@listUser']);

        // Route::get('/add',['uses'=>'UserManagerController@getAddUser']);
        Route::post('/add',['uses'=>'UserManagerController@postAddUser']);

        Route::get('/delete/{id}',['uses'=>'UserManagerController@deleteUser']);

        Route::get('/block/{id}',['uses'=>'UserManagerController@blockUser']);

        Route::get('/update/{id}',['uses'=>'UserManagerController@getUpdateUser']);
        Route::put('/update/{id}',['uses'=>'UserManagerController@putUpdateUser']);

        Route::get('/search',['uses'=>'UserManagerController@search']);
    });

    Route::group(['prefix'=>'supplier'],function(){
        Route::get('/',['uses'=>'SupplierController@getList']);

        Route::post('/add',['uses'=>'SupplierController@postAddSupplier']);

        Route::get('/delete/{id}',['uses'=>'SupplierController@deleteSupplier']);

        Route::get('/block/{id}',['uses'=>'SupplierController@blockSupplier']);
    });

    Route::group(['prefix'=>'category'],function(){
        Route::get('/',['uses'=>'CategoryController@getList']);

        Route::post('/add',['uses'=>'SupplierController@postAddSupplier']);

        Route::get('/delete/{id}',['uses'=>'SupplierController@deleteSupplier']);

        Route::get('/block/{id}',['uses'=>'SupplierController@blockSupplier']);
    });
});