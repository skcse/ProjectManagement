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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/user/register','UserController@register');

Route::patch('/user/{user}','UserController@update')->middleware('BasicAuth');

Route::post('/team/create','TeamController@store')->middleware('BasicAuth');

Route::get('/team/{team}','TeamController@show')->middleware('BasicAuth');

Route::patch('/team/{team}','TeamController@update')->middleware('BasicAuth');

Route::post('/project/create','ProjectController@store')->middleware('BasicAuth');

Route::patch('/project/{project}','ProjectController@update')->middleware('BasicAuth');

Route::get('/project/{project}','ProjectController@show')->middleware('BasicAuth');