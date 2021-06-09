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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//role route
Route::resource('roles','Backend\RoleController');
Route::get('roles/edit/{id}','Backend\RoleController@edit');
//permission route
Route::resource('permissions','Backend\PermissionController');
//voucher route
Route::resource('vouchers','Backend\VoucherController');
Route::get('/voucher/edit/{id}','VoucherController@edit');

//userVoucher route
Route::resource('user_vouchers','Backend\UserVoucherController');
Route::get('/user_voucher/edit/{id}','UserVoucherController@edit');
//user route
Route::resource('users','Backend\UserController');
Route::get('users/edit/{id}','UserController@edit');
