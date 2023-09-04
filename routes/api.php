<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});






//LOGIN
/* Route::post('/login',  '\App\Http\Controllers\AuthController@login');
Route::post('/new_user', '\App\Http\Controllers\UserController@store');
Route::post('/reset_password', '\App\Http\Controllers\UserController@resetPassword');

//CHECK TOKEN
Route::post('/check_token', '\App\Http\Controllers\AuthController@checkToken');

//AUTHETICATED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function() {

    //CUSTOMERS
    Route::resource('/customers', '\App\Http\Controllers\CustomerController');

    //ROLES
    Route::resource('/roles', '\App\Http\Controllers\RoleController');

    //PERMISSIONS
    Route::resource('/permissions', '\App\Http\Controllers\PermissionController');

    //USERS
    Route::resource('/users', '\App\Http\Controllers\UserController');

    //EVENTS
    Route::resource('/events', '\App\Http\Controllers\EventController');

    //CATEGORIES
    Route::resource('/categories', '\App\Http\Controllers\CategoryController');

    //PROFILES
    Route::resource('/profiles', '\App\Http\Controllers\ProfileController');

    //DAMAGES
    Route::resource('/damages', '\App\Http\Controllers\DamageController');

    //LOGOUT
    Route::post('/logout', '\App\Http\Controllers\AuthController@logout');
}); */
