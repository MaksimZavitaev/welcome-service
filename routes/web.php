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
Route::get('/', 'IndexController')->name('home');

Route::get('/auth/login', 'AuthController@login')->name('auth.login');
Route::post('/auth/logout', 'AuthController@logout')->name('auth.logout');
