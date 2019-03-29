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
Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');

Route::get('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

Route::get('/admin/deparment', 'Admin\DepartmentController@index')->name('admin.department');
Route::get('/admin/deparment/add', 'Admin\DepartmentController@create')->name('admin.department.add');
Route::post('/admin/deparment/add', 'Admin\DepartmentController@store')->name('admin.department.add');
Route::get('/admin/deparment/{id}/edit', 'Admin\DepartmentController@edit')->name('admin.department.edit');
Route::post('/admin/deparment/{id}/edit', 'Admin\DepartmentController@update')->name('admin.department.edit');
