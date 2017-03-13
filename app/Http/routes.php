<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware'=>'language'],function(){

    Route::auth();

    Route::group(['middleware'=>'auth'],function (){

        Route::get('/', 'HomeController@index');

        //routes for userManagement
        Route::post('users/store','UserController@store');
        Route::post('users/{id}/update','UserController@update');
        Route::post('users/{id}/delete','UserController@destroy');
        Route::get('users/{id}/myInfo','UserController@getInfo');
        Route::resource('users','UserController',['except'=>'show']);

        //routes for newsManagement
        Route::post('news/store','NewsController@store');
        Route::post('news/{id}/update','NewsController@update');
        Route::post('news/{id}/delete','NewsController@destroy');
        Route::resource('news','NewsController',['except'=>'show']);

        //routes for reports
        Route::get('usersInfo','ReportController@user');

        //routes for imports
        Route::get('usersImport','ImportController@importUsers');
        Route::post('usersImport','ImportController@saveUserImport');
        Route::get('usersExample','ImportController@importExample');
        Route::get('importLog/{id}/download','ImportController@download');
        Route::delete('importLog/{id}','ImportController@destroy');


    });

});



