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

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

//user
Route::get('/manage', 'UserController@manageTable')->name('manageTable');

//api
Route::post('/api/getAvailableTable', 'BookController@availableTable')->name('availableTable');
Route::post('/api/saveBook', 'BookController@saveBook')->name('saveBook');
