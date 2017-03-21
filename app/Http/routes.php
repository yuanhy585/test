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
        Route::get('news/{id}/push','NewsController@push');
        Route::get('news/{id}/revoke','NewsController@revoke');
        Route::resource('news','NewsController',['except'=>'show']);

        //routes for posts management
        Route::post('posts/store','PostController@store');
        Route::post('posts/{id}/update','PostController@update');
        Route::post('user/{user_id}/posts/{post_id}/delete','PostController@destroy');
        Route::resource('posts','PostController',['except'=>'show']);

        //routes for discussions management
        Route::get('post/{id}','DiscussionController@show');
        Route::post('post/{id}/delete','DiscussionController@destroy');
        Route::post('comment/store','DiscussionController@store');
        Route::resource('discussions','DiscussionController');

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



