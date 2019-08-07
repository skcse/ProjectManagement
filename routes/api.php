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


//new user register (W)
Route::post('/user/register','UserController@register');

//admin update the user team_id and role (W)
Route::patch('/user/{user}','UserController@update')->middleware('BasicAuth');

//user can view his projects
Route::get('/user/projects','UserController@projects')->middleware('BasicAuth');

//user can view his invitations
Route::get('/user/invitations/{user}','UserController@invitations')->middleware('BasicAuth');

//lead can see his the invites he sent
Route::get('/user/invites','UserController@invited')->middleware('BasicAuth');

//admin will create a team (W)
Route::post('/team/create','TeamController@store')->middleware('BasicAuth');

//User can see the team details if he belongs to that team (W) --review
Route::get('/team/{team}','TeamController@show')->middleware('BasicAuth');

//admin can update the team details
Route::patch('/team/{team}','TeamController@update')->middleware('BasicAuth');

//user can view his team member if he belongs to that team (W)
Route::get('/team/{team}/showMember','TeamController@showMember')->middleware('BasicAuth');

//user can view all project of his team
Route::get('/team/{team}/showProject','TeamController@showProject')->middleware('BasicAuth');


//Lead of any team can create a project which will belong to this team (W)
Route::post('/project/create','ProjectController@store')->middleware('BasicAuth');

//Lead of a project can edit the project details (W)
Route::patch('/project/{project}','ProjectController@update')->middleware('BasicAuth');

//User can see the project details if he belongs to that project (W) --review
Route::get('/project/{project}','ProjectController@show')->middleware('BasicAuth');

//Lead of project can add member to this project (W)
Route::post('/project/{project}/addMember','ProjectController@addmember')->middleware('BasicAuth');

//User can view the project member if he belongs to that project (W) --review
Route::get('/project/{project}/showMember','ProjectController@showmember')->middleware('BasicAuth');



Route::get('/mail/{user}','UserController@userMail')->middleware('BasicAuth');

Route::get('/invite/{project}/{user}','InvitationController@store')->middleware('BasicAuth');

