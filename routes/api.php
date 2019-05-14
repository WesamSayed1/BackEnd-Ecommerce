<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user',function(Request $request){

    return $request->user;
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', 'Api\AuthController@login');
    Route::post('/logout', 'Api\AuthController@logout');
    Route::post('/refresh', 'Api\AuthController@refresh');
    Route::post('/me', 'Api\AuthController@me');

});


Route::get('/','Api\DashboardController@index');
Route::apiresource('/users','Api\UsersController');
Route::apiresource('/products','Api\ProductController');
Route::apiresource('/tags','Api\TagsController');
Route::apiresource('/orders','Api\OrderController');


