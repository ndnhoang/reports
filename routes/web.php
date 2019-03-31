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

Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

/* Department */

Route::get('/admin/department', 'Admin\DepartmentController@index')->name('admin.department');
Route::get('/admin/department/add', 'Admin\DepartmentController@create')->name('admin.department.add');
Route::post('/admin/department/add', 'Admin\DepartmentController@store')->name('admin.department.add');
Route::get('/admin/department/{id}/edit', 'Admin\DepartmentController@edit')->name('admin.department.edit');
Route::post('/admin/department/{id}/edit', 'Admin\DepartmentController@update')->name('admin.department.edit');
Route::post('/admin/department/{id}/delete', 'Admin\DepartmentController@destroy')->name('admin.department.delete');

/* Admin */

Route::get('/admin/admin', 'Admin\AdminController@index')->name('admin.admin');
Route::get('/admin/admin/add', 'Admin\AdminController@create')->name('admin.admin.add');
Route::post('/admin/admin/add', 'Admin\AdminController@store')->name('admin.admin.add');
Route::get('/admin/admin/{id}/reset-password', 'Admin\AdminController@edit')->name('admin.admin.reset.password');
Route::post('/admin/admin/{id}/reset-password', 'Admin\AdminController@update')->name('admin.admin.reset.password');
Route::post('/admin/admin/{id}/delete', 'Admin\AdminController@destroy')->name('admin.admin.delete');

Route::post('/admin/admin/generate-password', 'Admin\AdminController@generatePassword')->name('admin.admin.generate.password');

/* User */

Route::get('/admin/user', 'Admin\UserController@index')->name('admin.user');
Route::get('/admin/user/add', 'Admin\UserController@create')->name('admin.user.add');
Route::post('/admin/user/add', 'Admin\UserController@store')->name('admin.user.add');
Route::get('admin/user/{id}/reset-password', 'Admin\UserController@edit')->name('admin.user.reset.password');
Route::post('admin/user/{id}/reset-password', 'Admin\UserController@update')->name('admin.user.reset.password');
Route::post('admin/user/{id}/delete', 'Admin\UserController@destroy')->name('admin.user.delete');

Route::post('/admin/user/generate-password', 'Admin\UserController@generatePassword')->name('admin.user.generate.password');
