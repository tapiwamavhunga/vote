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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user(); 
}); 

Route::group(['middleware' => 'auth'], function() {

});
 
Route::apiResources(['user' => 'API\UserController']);  
Route::get('authuser', 'API\UserController@authuser');   
Route::get('protocol', 'API\UserController@protocol');   
Route::post('voted', 'API\VoterController@voted');  
Route::post('notification', 'API\VoterController@notification');  
Route::apiResources(['voters' => 'API\VoterController']);  
Route::apiResources(['candidates' => 'API\MinisterController']);  
Route::get('totalUsers', 'API\UserController@totalUsers'); 
Route::get('totalLogins', 'API\UserController@totalLogins');  