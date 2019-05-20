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
    Route::prefix('employees/{employee}')->as('employees.')->group(function() {
        Route::put('page/first_day', 'EmployeeController@updateFirstDayPage')->name('first_day.update');
        Route::delete('page/first_day', 'EmployeeController@deleteFirstDayPage')->name('first_day.delete');
        Route::post('send/welcome_mail', 'EmployeeController@sendWelcomeMail')->name('send_welcome_mail');
        Route::post('send/welcome_sms', 'EmployeeController@sendWelcomeSMS')->name('send_welcome_sms');
        Route::post('generate_short_link', 'EmployeeController@generateShortLink')->name('generate_short_link');
    });
    Route::resource('categories', 'CategoryController')->except(['show']);
    Route::resource('pages', 'PageController')->except(['show']);
    Route::resource('options', 'OptionController')->except(['show', 'create', 'store', 'delete']);
});
