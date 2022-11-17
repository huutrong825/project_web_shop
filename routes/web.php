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

Route::group(
    ['middleware'=>'AdminLogin', 'prefix'=>'admin'], function () {

        Route::get(
            '/', function () {
                return view('Admin/admin_index');
            }
        );

        Route::get('/profile', ['uses'=>'AuthController@getProfile']);
        Route::post('/profile', ['uses'=>'AuthController@updateProfile']);
        Route::post('/profile/changepass', ['uses'=>'AuthController@changePass']);

        Route::get('/logout', ['uses'=>'AuthController@getLogout']);
        //User
        Route::group(
            ['prefix'=>'user'], function () {

                Route::get('/', ['uses'=>'UserManagerController@index']);

                Route::get('/fetch', ['uses'=>'UserManagerController@listUser']);

                Route::post('/add', ['uses'=>'UserManagerController@postAddUser']);

                Route::get('/getId/{id}', ['uses'=>'UserManagerController@getUser']);

                Route::get('/delete/{id}', ['uses'=>'UserManagerController@deleteUser']);

                Route::get('/block/{id}', ['uses'=>'UserManagerController@blockUser']);

                Route::put('/update/{id}', ['uses'=>'UserManagerController@putUpdateUser']);
            }
        );
        //Supplier
        Route::group(
            ['prefix'=>'supplier'], function () {

                Route::get('/', ['uses'=>'SupplierController@index']);

                Route::get('/fetch', ['uses'=>'SupplierController@getSupplier']);

                Route::post('/add', ['uses'=>'SupplierController@postAdd']);

                Route::get('/getId/{id}', ['uses'=>'SupplierController@getIDSupplier']);

                Route::get('/delete/{id}', ['uses' => 'SupplierController@deleteSupplier']);

                Route::put('/block/{id}', ['uses'=>'SupplierController@blockSupplier']);

                Route::put('/update/{id}', ['uses'=>'SupplierController@UpdateSupp']);
            }
        );
        // Category
        Route::group(
            ['prefix'=>'category'], function () {
                Route::get('/', ['uses'=>'CategoryController@index']);

                Route::get('/fetch', ['uses'=>'CategoryController@getCate']);

                Route::post('/add', ['uses'=>'CategoryController@addCate']);

                Route::get('/getId/{id}', ['uses'=>'CategoryController@getCateId']);

                Route::put('/update/{id}', ['uses'=>'CategoryController@updateCate']);

                Route::delete('/delete/{id}', ['uses'=>'CategoryController@deleteCate']);
            }
        );
        // Product
        Route::group( 
            ['prefix'=>'product'], function () {

                Route::get('/', ['uses'=>'ProductController@index']);

                Route::get('/fetch', ['uses'=>'ProductController@listProduct']);

                Route::get('/add', ['uses'=>'ProductController@addProduct']);

                Route::get('/getId/{id}', ['uses'=>'ProductController@getIdProduct']);

                Route::get('/block/{id}', ['uses'=>'ProductController@blockProduct']);

                Route::get('/delete/{id}', ['uses'=>'ProductController@deleteProduct']);

                Route::put('/update/{id}', ['uses'=>'ProductController@updatePro']);

                Route::post('/loadImg/{id}', ['uses'=>'ProductController@uploadImg']);

                Route::get('/dropImage/{id}', ['uses'=>'ProductController@dropIndex']);

                Route::post('/dropImage/{id}', ['uses'=>'ProductController@imageDrop']);

                Route::get('/preview/{id}', ['uses'=>'ProductController@getImage']);

                Route::get('/remove/{id}', ['uses'=>'ProductController@removeImage']);
            }
        );
        // Unit
        Route::group( 
            ['prefix'=>'unit'], function () {

                Route::get('/', ['uses'=>'UnitController@index']);

                Route::get('/fetch', ['uses'=>'UnitController@listUnit']);

                Route::post('/add', ['uses'=>'UnitController@addUnit']);

                Route::get('/getId/{id}', ['uses'=>'UnitController@getId']);

                Route::get('/delete/{id}', ['uses'=>'UnitController@deleteUnit']);

                Route::put('/update/{id}', ['uses'=>'UnitController@updateUnit']);
            }
        );
        //Discount
        Route::group( 
            ['prefix'=>'discount'], function () {

                Route::get('/', ['uses'=>'DiscountController@index']);

                Route::get('/fetch', ['uses'=>'DiscountController@listDis']);

                Route::post('/add', ['uses'=>'DiscountController@addDis']);

                Route::get('/getId/{id}', ['uses'=>'DiscountController@getDis']);

                Route::get('/delete/{id}', ['uses'=>'DiscountController@deleteDis']);

                Route::get('/block/{id}', ['uses'=>'DiscountController@blockDis']);

                Route::put('/update/{id}', ['uses'=>'DiscountController@updateDis']);

                Route::post('/add-product', ['uses'=>'DiscountController@linkPro']);
            }
        );
        //Customer
        Route::group(
            ['prefix'=>'customer'], function () {

                Route::get('/', ['uses'=>'CustomerController@index']);

                Route::get('/fetch', ['uses'=>'CustomerController@listCus']);

                Route::post('/add', ['uses'=>'CustomerController@addCus']);

                Route::get('/getId/{id}', ['uses'=>'CustomerController@getId']);

                Route::put('/update/{id}', ['uses'=>'CustomerController@updateCus']);

                Route::get('/export', ['uses'=>'CustomerController@export']);
                Route::get('/exportPDF', ['uses'=>'CustomerController@exportPDF']);
            }
        );
        // Order
        Route::group( 
            ['prefix'=>'order'], function () {

                Route::get('/', ['uses'=>'OrderController@index']);
                Route::get('/process', ['uses'=>'OrderController@processIndex']);
                Route::get('/complete', ['uses'=>'OrderController@completeIndex']);

                Route::get('/fetch', ['uses'=>'OrderController@listOrder']);
                Route::get('/fetchprocess', ['uses'=>'OrderController@processOrder']);
                Route::get('/fetchcomplete', ['uses'=>'OrderController@orderComplete']);

                Route::get('/info/{id}', ['uses'=>'OrderController@infoOrder']);

                Route::put('/stateUp/{id}', ['uses'=>'OrderController@stateOrder']);

                Route::get('/detail/{id}', ['uses'=>'OrderController@detail']);

            }
        );
        // Statistical
        Route::group( 
            ['prefix'=>'statistical'], function () {

                Route::get('/overview', ['uses'=>'StatisticalController@overview_index']);

                Route::get('/fetch', ['uses'=>'StatisticalController@data']);

                Route::get('/order_statis', ['uses'=>'StatisticalController@order_statis']);

                Route::get('/fetch_order', ['uses'=>'StatisticalController@order_product']);

                Route::get('/datatable', ['uses'=>'StatisticalController@datatable']);

                Route::get('/export', ['uses'=>'StatisticalController@exportXLS']);
            }
        );
    }
);