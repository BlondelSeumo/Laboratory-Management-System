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


//authorization
Route::post('register','Auth\ApiController@register')->name('register');
Route::post('login','Auth\ApiController@login')->name('login');
Route::post('forget_code','Auth\ApiController@forget_code');

//patient dashboard
Route::group(['namespace'=>'Api','prefix'=>'patient','middleware'=>'auth:api'],function(){
    Route::get('dashboard','ProfileController@dashboard');
    Route::post('update_profile','ProfileController@update_profile');
    Route::get('group_tests','GroupTestsController@group_tests');
    Route::post('visit','VisitsController@store');
    Route::get('branches','BranchesController@index');
    Route::get('tests','TestsLibraryController@tests');
    Route::get('cultures','TestsLibraryController@cultures');
});
