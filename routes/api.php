<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>'AdminLogin', 'prefix'=>'admin'],function(){

    Route::get('/',function(){
        return view('Admin/admin_index');
    });

    Route::get('/profile', ['uses'=>'AuthController@getProfile']);
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
