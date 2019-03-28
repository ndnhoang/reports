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
    return view('form');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Admin */

Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard');

Route::get('/admin/login', 'Admin\Auth\LoginController@index')->name('admin.login');
Route::post('/admin/login', 'Admin\Auth\LoginController@checkLogin')->name('admin.login');
