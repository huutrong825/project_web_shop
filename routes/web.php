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

Route::get('/login', ['uses'=>'AuthController@getLogin']);
Route::post('/login', ['uses'=>'AuthController@postLogin']);

Route::get('/register', ['uses'=>'AuthController@getRegister']);
Route::post('/register', ['uses'=>'AuthController@postRegister']);

Route::group(['middleware'=>'AdminLogin', 'prefix'=>'admin'], function(){

    Route::get('/', function(){
        return view('Admin/admin_index');
    });

    Route::get('/profile', ['uses'=>'AuthController@getProfile']);
    Route::post('/profile', ['uses'=>'AuthController@updateProfile']);

    Route::get('/logout', ['uses'=>'AuthController@getLogout']);

    Route::group(['prefix'=>'user'], function(){

        Route::get('/', ['uses'=>'UserManagerController@index']);

        Route::get('/fetch', ['uses'=>'UserManagerController@listUser']);

        Route::post('/add', ['uses'=>'UserManagerController@postAddUser']);

        Route::get('/getUserDelete/{id}', ['uses'=>'UserManagerController@getUser']);
        Route::get('/delete/{id}', ['uses'=>'UserManagerController@deleteUser']);

        Route::get('/getUserBlock/{id}', ['uses'=>'UserManagerController@getUser']);
        Route::get('/block/{id}', ['uses'=>'UserManagerController@blockUser']);

        Route::get('/update/{id}', ['uses'=>'UserManagerController@getUser']);
        Route::put('/update/{id}', ['uses'=>'UserManagerController@putUpdateUser']);

        Route::get('/search', ['uses'=>'UserManagerController@search']);
    });

    Route::group(['prefix'=>'supplier'], function(){

        Route::get('/', ['uses'=>'SupplierController@index']);

        Route::get('/fetch', ['uses'=>'SupplierController@getSupplier']);

        Route::post('/add', ['uses'=>'SupplierController@postAddSupplier']);

        Route::get('/delete/{id}', ['uses'=>'SupplierController@getIDSupplier']);
        Route::delete('/delete/{id}', ['uses'=>'SupplierController@deleteSupplier']);

        Route::get('/block/{id}', ['uses'=>'SupplierController@getIDSupplier']);
        Route::put('/block/{id}', ['uses'=>'SupplierController@blockSupplier']);

        Route::get('/update/{id}', ['uses'=>'SupplierController@getIDSupplier']);
        Route::put('/update/{id}', ['uses'=>'SupplierController@UpdateSupp']);
    });

    Route::group(['prefix'=>'category'], function(){

        Route::get('/', ['uses'=>'CategoryController@index']);

        Route::get('/fetch', ['uses'=>'CategoryController@getCate']);

        Route::post('/add', ['uses'=>'CategoryController@addCate']);

        Route::get('/update/{id}', ['uses'=>'CategoryController@getCateId']);
        Route::put('/update/{id}', ['uses'=>'CategoryController@updateCate']);

        Route::get('/delete/{id}', ['uses'=>'CategoryController@getCateId']);
        Route::delete('/delete/{id}', ['uses'=>'CategoryController@deleteCate']);
    });

    Route::group(['prefix'=>'product'], function(){

        Route::get('/', ['uses'=>'ProductController@index']);
        Route::get('/fetch', ['uses'=>'ProductController@listProduct']);

        Route::get('/add', ['uses'=>'ProductController@addProduct']);
    });
});