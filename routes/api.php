<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/timeregistration', function (Request $request) {
    return $request->timeregistration();
});

Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');


Route::get('timeregistrationShow', 'API\TimeregistrationController@show');
Route::get('timeregistrationShowApprovals', 'API\TimeregistrationController@showApprovals');
Route::get('timeregistrationShowApprovalsAll', 'API\TimeregistrationController@showApprovalsAll');
Route::get('timeregistrationShowAllAdmin', 'API\TimeregistrationController@showAllAdmin');
Route::get('timeregistrationShowAllSupervisor', 'API\TimeregistrationController@showAllSupervisor');
Route::get('usersSupervisor', 'API\UserController@show');
Route::get('usersShowAll', 'API\UserController@showAll');

Route::apiResources(['user' => 'API\UserController']);

Route::apiResources(['timeregistration' => 'API\TimeregistrationController']);
