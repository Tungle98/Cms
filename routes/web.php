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
    return view('auth.login');
});
Route::post('/login-firebase', 'LoginController@loginByFirebase');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//permission route
Route::resource('permissions','Backend\PermissionController');
Route::post('permissions/update', 'Backend\PermissionController@update')->name('permissions.update');

Route::get('permissions/destroy/{id}', 'Backend\PermissionController@destroy');
//property route
Route::resource('properties','Backend\PropertyController');

Route::resource('voucher_types','Backend\VoucherTypeController');
Route::group(['prefix'=>'admin','namespace'=>'Backend', 'middleware'=>'auth'], function (){
    //voucher route
    Route::get('/voucher','VoucherController@index')->name('admin.voucher');
    Route::get('/voucher/getTableData','VoucherController@get')->name('admin.voucher.getTableData');
    Route::post('/voucher','VoucherController@store');
    Route::get('/voucher/edit/{id}','VoucherController@edit');
    Route::post('/voucher/update','VoucherController@update')->name('admin.voucher.update');
    Route::get('/voucher/show/{id}','VoucherController@show');
    Route::get('/voucher/delete/{id}','VoucherController@delete');
    Route::get('/voucher/publish/{id}','VoucherController@publish')->name('voucher.publish');
    Route::get('/voucher/unpublish/{id}','VoucherController@unpublish')->name('voucher.unpublish');
    Route::get('/voucher/update', 'VoucherController@updateStatus')->name('admin.voucher.update-status');

    //userVoucher route
    Route::get('/user_voucher','UserVoucherController@index')->name('admin.voucher_user');
    Route::get('/user_voucher/getTableData','UserVoucherController@get')->name('admin.voucher_user.getTableData');
    Route::post('/user_voucher','UserVoucherController@store');
    Route::get('/user_voucher/edit/{id}','UserVoucherController@edit');
    Route::get('/user_voucher/show/{id}','UserVoucherController@show');
    Route::post('/user_voucher/update','UserVoucherController@update')->name('admin.voucher_user.update');
    Route::get('/user_voucher/delete/{id}','UserVoucherController@delete');

    Route::post('/user_voucher/addUserVoucher','UserVoucherController@addVoucherUser')->name('admin.voucher_user.add');

    //user route
    Route::get('/user','UserController@index')->name('admin.user');
    Route::get('/user/getTableData','UserController@get')->name('admin.user.getTableData');
    Route::post('/user','UserController@store');
    Route::get('/user/edit/{id}','UserController@edit');
    Route::post('/user/update','UserController@update')->name('admin.user.update');
    Route::get('/user/delete/{id}','UserController@delete')->name('admin.user.delete');
    //role route
    Route::get('/role','roleController@index')->name('admin.role');
    Route::post('/role','roleController@store');
    Route::get('/role/edit/{id}','roleController@edit');
    Route::post('/role/update','roleController@update')->name('admin.role.update');
    Route::get('/role/delete/{id}','roleController@delete');

    //route hotel
    Route::get('/hotel','HotelController@index')->name('admin.hotel');
    Route::get('/hotel/getTableData','HotelController@get')->name('admin.hotel.getTableData');
    Route::post('/hotel','HotelController@store');
    Route::get('/hotel/edit/{id}','HotelController@edit');
    Route::get('/hotel/show/{id}','HotelController@show');
    Route::post('/hotel/update','HotelController@update')->name('admin.hotel.update');
    Route::get('/hotel/delete/{id}','HotelController@delete');
    Route::get('/hotel/create','HotelController@create');
//    find address by api
    Route::post('find', 'HotelController@find')->name('search');
    Route::post('search', 'HotelController@search')->name('admin.search');



    //route manager service airport
    Route::get('/airport','AirportController@index')->name('admin.airport');
    Route::get('/airport/getTableData','AirportController@get')->name('admin.airport.getTableData');
    Route::post('/airport','AirportController@store');
    Route::get('/airport/edit/{id}','AirportController@edit');
    Route::get('/airport/show/{id}','AirportController@show');
    Route::post('/airport/update','AirportController@update')->name('admin.airport.update');
    Route::get('/airport/delete/{id}','AirportController@delete');

    Route::get('airport/export/', 'AirportController@export');
});
