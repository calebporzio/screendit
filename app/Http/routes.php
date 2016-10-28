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

Route::get('/', 'SiteController@showHome');
Route::get('/docs', 'SiteController@showDocs');
Route::get('/pricing', 'SiteController@showPricing');

Route::get('/home', 'HomeController@show');
Route::get('/s3-guide', 'HomeController@showS3Guide');
