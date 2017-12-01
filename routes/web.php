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

Route::get('/customer', 'CustomerController@showCustomer');

//Route to get one customer by ID
Route::get('customers/{id}', 'CustomerController@showCustomersId');

Route::get('customers/{id}/address', 'CustomerController@showCustomerAddress');

Route::get('/customers/by-company/{company_id}', 'CustomerController@customersByCompanyId');

Route::get('/fb-login', 'FacebookController@index');
Route::get('/login', 'FacebookController@loginForm');
Route::get('/facebook', 'FacebookController@fbShow');

