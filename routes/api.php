<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//LOGIN
Route::post('/login',  '\App\Http\Controllers\AuthController@login');
Route::post('/new_user', '\App\Http\Controllers\UserController@store');
Route::post('/reset_password', '\App\Http\Controllers\UserController@resetPassword');

//CHECK TOKEN
Route::post('/check_token', '\App\Http\Controllers\AuthController@checkToken');

//AUTHETICATED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function() {

    //ROLES
    Route::resource('/roles', '\App\Http\Controllers\RoleController');

    //PERMISSIONS
    Route::resource('/permissions', '\App\Http\Controllers\PermissionController');

    //USERS
    Route::resource('/users', '\App\Http\Controllers\UserController');

    //VEHICLES
    Route::resource('/vehicles', '\App\Http\Controllers\VehicleController');

    //LOGOUT
    Route::post('/logout', '\App\Http\Controllers\AuthController@logout');

    //API BRASIL SERVICE
    Route::post('/api_brasil_vehicles', '\App\Http\Controllers\Service\ApiBrasilServiceController@vehicles');
});
