<?php

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

Route::post('login', 'ApiAuthenticationController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('skills', 'ApiSkillController@index');
    Route::get('challenges', 'ApiChallengeController@index');
    Route::post('challenges', 'ApiChallengeController@store');
    Route::patch('challenges/{challenge}', 'ApiChallengeController@update');
    Route::post('challenges/{challenge}/complete', 'ApiChallengeController@complete');
    Route::post('challenges/{challenge}/comments', 'ApiChallengeCommentController@store');
    Route::get('users', 'ApiUserController@index');
    Route::get('levels', 'ApiLevelController@index');
    Route::get('localOfficer/{lat}/{long}', 'PolitieApiController@localOfficer')->name('politie.localofficer');
});

