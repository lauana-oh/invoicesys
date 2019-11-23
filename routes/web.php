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
    return view('auth.login');
});

/*------Authentication's Routes----*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*------Products' Routes-----------*/
Route::resource('/products','ProductController');

Route::get('/products/{id}/confirmDelete','ProductController@confirmDelete');

/*------Companies' Routes-----------*/
Route::resource('/companies','CompanyController');

Route::get('/companies/{id}/confirmDelete','CompanyController@confirmDelete');

/*------Categories' Routes-----------*/
Route::resource('/categories','CategoryController');

Route::get('/categories/{id}/confirmDelete','CategoryController@confirmDelete');

/*------Invoices' Routes-----------*/
Route::resource('/invoices','InvoiceController');

Route::get('/invoices/{id}/confirmDelete','InvoiceController@confirmDelete');

/*------Invoices' Routes-----------*/
Route::resource('/invoices/{invoice}/orders','OrderController');

Route::get('/invoices/{invoice}/orders/{order}/confirmDelete','OrderController@confirmDelete');