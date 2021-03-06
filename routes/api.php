<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes for creating a user and auth
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

// List all customers
Route::get('customers', 'CustomerController@index');
// list single customer
Route::get('customer/{id}', 'CustomerController@show');
// Create a new customer
Route::post('customer', 'CustomerController@store')->middleware('auth:api');
// Update a customer
Route::put('customer/{id}', 'CustomerController@update')->middleware('auth:api');
// Delete a customer
Route::delete('customer/{id}', 'CustomerController@destroy')->middleware('auth:api');
// Show all dependents of a customer
Route::get('customer/{id}/dependents', 'CustomerController@showDependents')->middleware('auth:api');

// List all dependents
Route::get('dependents', 'DependentController@index');
// list single dependent
Route::get('dependent/{id}', 'DependentController@show');
// Create a new dependent
Route::post('dependent', 'DependentController@store')->middleware('auth:api');
// Update a dependent
Route::put('dependent/{id}', 'DependentController@update')->middleware('auth:api');
// Delete a dependent
Route::delete('dependent/{id}', 'DependentController@destroy')->middleware('auth:api');
// Show customer of a given dependent
Route::get('dependent/{id}/customer', 'DependentController@showCustomer')->middleware('auth:api');

// Lista all customers user
Route::get('user/{id}/customers', 'UserController@customers')->middleware('auth:api');
// Lista all customers user
Route::get('user/{id}/dependent', 'UserController@dependents')->middleware('auth:api');

Route::fallback(function() {
    return response()->json([
        'message' => 'Invalid route'
    ], 404);
});
