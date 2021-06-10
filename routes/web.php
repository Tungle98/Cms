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
//role route
Route::resource('roles','Backend\RoleController');
//permission route
Route::resource('permissions','Backend\PermissionController');
Route::post('permissions/update', 'Backend\PermissionController@update')->name('permissions.update');

Route::get('permissions/destroy/{id}', 'Backend\PermissionController@destroy');


//user route
Route::resource('users','Backend\UserController');
Route::get('users/{id}/edit/','UserController@edit');
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
    Route::post('/user_voucher/update','UserVoucherController@update')->name('admin.voucher_user.update');
    Route::get('/user_voucher/delete/{id}','UserVoucherController@delete');
});
