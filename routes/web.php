<?php

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
Route::view('/user-login', 'login');

Route::get('/user-register', [
    'uses' => 'FrontEndController@register', 
    'as' => 'register'  
]);   

Route::get('/', [
    'uses' => 'FrontEndController@index', 
    'as' => 'welcome'  
]);  
Route::get('/', [
    'uses' => 'FrontEndController@index', 
    'as' => 'login' 
]); 
Route::get('/privacy', [
    'uses' => 'FrontEndController@privacy', 
    'as' => 'privacy' 
]); 
Route::get('/contact', [
    'uses' => 'FrontEndController@contact', 
    'as' => 'contact' 
]); 
Route::get('/list', [
    'uses' => 'FrontEndController@list', 
    'as' => 'list' 
]); 
Route::get('/single', [
    'uses' => 'FrontEndController@single', 
    'as' => 'single' 
]); 

Route::get('/logout', function() {
    auth()->logout();
    return redirect('/'); 
});

Route::get('/test', [ 
    'uses' => 'FrontEndController@test',
    'as' => 'test'
]);


Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('home', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');