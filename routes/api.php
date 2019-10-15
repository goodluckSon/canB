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

Route::middleware('auth:api')->get('/user', "HomeController@User");
Route::middleware('auth:api')->put('/user', "HomeController@UpdateUser");
Route::middleware('auth:api')->resource('/locations', "AddressController");
Route::middleware('auth:api')->resource('/images', "ImageController");
Route::middleware('auth:api')->resource('/flakes', "FlakeController");
Route::middleware('auth:api')->delete('/logout', "HomeController@Logout");

Route::post('/register',"HomeController@Register")->name('api.register');

//middleware(['admin'])->
Route::namespace('Admin')->prefix('administration')->name('api.admin.')->group(function(){
    Route::post('/register',"ApiController@Register")->name('register');    
    Route::resource('addons',"AddonController");
    Route::resource('designs',"DesignController");
});