<?php

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
    return view('auth.index');
});

Auth::routes();

Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/setting', 'SettingController@index')->name('setting');
Route::get('/sales', 'SalesController@index')->name('sales');
Route::get('/sync', 'SalesController@sycinvoice')->name('sync');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
