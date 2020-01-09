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
    return view('welcome');
});

/*------Authentication's Routes----*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*------Products' Routes-----------*/
Route::resource('/products','ProductController');

Route::get('/products/{id}/confirmDelete','ProductController@confirmDelete')->name('products.confirmDelete');

Route::any('/products/search', 'ProductController@search')->name('products.search');

/*------Companies' Routes-----------*/
Route::resource('/companies','CompanyController');

Route::get('/companies/{id}/confirmDelete','CompanyController@confirmDelete')->name('companies.confirmDelete');

Route::any('/company/search', 'CompanyController@search')->name('companies.search');

/*------Categories' Routes-----------*/
Route::resource('/categories','CategoryController');

Route::get('/categories/{id}/confirmDelete','CategoryController@confirmDelete')->name('categories.confirmDelete');

Route::any('/categories/search', 'CategoryController@search')->name('categories.search');

/*------Invoices' Routes-----------*/
Route::resource('/invoices','InvoiceController');

Route::get('/invoices/{id}/confirmDelete','InvoiceController@confirmDelete')->name('invoices.confirmDelete');

Route::any('/invoice/search', 'InvoiceController@search')->name('invoices.search');

/*------Orders' Routes-----------*/
Route::resource('/invoices/{invoice}/orders','OrderController');

Route::get('/invoices/{invoice}/orders/{order}/confirmDelete','OrderController@confirmDelete')->name('orders.confirmDelete');