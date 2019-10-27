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
Route::get('/success', 'HomeController@success')->name('success');

//user
Route::get('/manage', 'UserController@manageTable')->name('manageTable');

//api
Route::post('/api/getAvailableTable', 'BookController@availableTable')->name('availableTable');
Route::post('/api/saveBook', 'BookController@saveBook')->name('saveBook');
Route::post('/api/getBookByID', 'BookController@getBookByID')->name('getBookByID');
Route::post('/api/saveOrder', 'BookController@saveOrder')->name('saveOrder');
Route::post('/api/cancelOrder', 'BookController@cancelOrder')->name('cancelOrder');
Route::post('/api/editNormalUser', 'AdminController@editNormalUser')->name('editNormalUser');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
  Route::get('/', 'AdminController@index');

  Route::group(['prefix' => 'api'], function(){
    //Reservation
    Route::post('/deleteReservation', 'AdminController@deleteReservation')->name('deleteReservation');

    //Product
    Route::post('/addProduct', 'AdminController@addProduct')->name('addProduct');
    Route::post('/editProduct', 'AdminController@editProduct')->name('editProduct');
    Route::post('/deleteProduct', 'AdminController@deleteProduct')->name('deleteProduct');

    //Item
    Route::post('/addItem', 'AdminController@addItem')->name('addItem');
    Route::post('/editItem', 'AdminController@editItem')->name('editItem');
    Route::post('/deleteItem', 'AdminController@deleteItem')->name('deleteItem');

    //Item
    Route::post('/addTable', 'AdminController@addTable')->name('addTable');
    Route::post('/editTable', 'AdminController@editTable')->name('editTable');
    Route::post('/deleteTable', 'AdminController@deleteTable')->name('deleteTable');

    //Users
    Route::post('/editUser', 'AdminController@editUser')->name('editUser');
    Route::post('/deleteUser', 'AdminController@deleteUser')->name('deleteUser');
  });
});
