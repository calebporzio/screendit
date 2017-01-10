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

Route::get('/', 'SiteController@showMarketingPage');
Route::get('/docs', 'SiteController@showDocs');
Route::get('/pricing', 'SiteController@showPricing');

Route::get('/home', 'DashboardController@showDashboard');
Route::get('/s3-guide', 'DashboardController@showS3Guide');
