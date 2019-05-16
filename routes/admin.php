<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('', 'IndexController@index');

    Route::resource('users', 'UserController')->except(['show']);
    Route::resource('departments', 'DepartmentController')->except(['show']);
    Route::resource('employees', 'EmployeeController')->except(['show']);
    Route::put('employees/{employee}/page/first_day', 'EmployeeController@updateFirstDayPage')->name('employees.first_day.update');
    Route::delete('employees/{employee}/page/first_day', 'EmployeeController@deleteFirstDayPage')->name('employees.first_day.delete');
    Route::resource('categories', 'CategoryController')->except(['show']);
    Route::resource('pages', 'PageController')->except(['show']);
});
