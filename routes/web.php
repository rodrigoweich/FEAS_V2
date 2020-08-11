<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/users', 'UserController', ['except' => ['show']]);
    Route::post('users/search', 'UserController@search')->name('users.search');
    Route::resource('/roles', 'RoleController', ['except' => ['show']]);
    Route::post('roles/search', 'RoleController@search')->name('roles.search');
    Route::resource('/states', 'StateController', ['except' => ['show']]);
    Route::post('states/search', 'StateController@search')->name('states.search');
    Route::resource('/cities', 'CityController', ['except' => ['show']]);
    Route::post('cities/search', 'CityController@search')->name('cities.search');
});

Route::get('/profile/{id}', 'UserController@showProfile')->name('users.profile');
Route::put('/profile/{id}', 'UserController@updateProfile')->name('users.profile.update');