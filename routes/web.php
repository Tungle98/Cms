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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//permission route
Route::resource('permissions','Backend\PermissionController');
Route::post('permissions/update', 'Backend\PermissionController@update')->name('permissions.update');

Route::get('permissions/destroy/{id}', 'Backend\PermissionController@destroy');



Route::group(['prefix'=>'admin','namespace'=>'Backend', 'middleware'=>'auth'], function (){
    //voucher route
    Route::get('/voucher','VoucherController@index')->name('admin.voucher');
    Route::post('/voucher','VoucherController@store');
    Route::get('/voucher/edit/{id}','VoucherController@edit');
    Route::post('/voucher/update','VoucherController@update')->name('admin.voucher.update');
    Route::get('/voucher/delete/{id}','VoucherController@delete');

    //userVoucher route
    Route::get('/user_voucher','UserVoucherController@index')->name('admin.voucher_user');
    Route::post('/user_voucher','UserVoucherController@store');
    Route::get('/user_voucher/edit/{id}','UserVoucherController@edit');
    Route::get('/user_voucher/show/{id}','UserVoucherController@show');
    Route::post('/user_voucher/update','UserVoucherController@update')->name('admin.voucher_user.update');
    Route::get('/user_voucher/delete/{id}','UserVoucherController@delete');

    Route::post('user_voucher/addUserVoucher','UserVoucherController@addVoucherUser')->name('admin.voucher_user.add');

    //user route
    Route::get('/user','UserController@index')->name('admin.user');
    Route::post('/user','UserController@store');
    Route::get('/user/edit/{id}','UserController@edit');
    Route::post('/user/update','UserController@update')->name('admin.user.update');
    Route::get('/user/delete/{id}','UserController@delete');
    //role route
    Route::get('/role','roleController@index')->name('admin.role');
    Route::post('/role','roleController@store');
    Route::get('/role/edit/{id}','roleController@edit');
    Route::post('/role/update','roleController@update')->name('admin.role.update');
    Route::get('/role/delete/{id}','roleController@delete');
});
