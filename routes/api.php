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

APIRoute::version( 'v1', [ 'middleware' => 'api' ], function ( $api ) {
	APIRoute::resource( 'challenges', 'App\Http\Controllers\ChallengeController' );
	APIRoute::get( 'challenges/{challenge}/resources', 'App\Http\Controllers\ChallengeController@showResources' );
	APIRoute::post( 'challenges/{challenge}/resources', 'App\Http\Controllers\ChallengeController@storeResource' );
	APIRoute::get( 'challenges/{challenge}/questions', 'App\Http\Controllers\ChallengeController@showQuestions' );
	APIRoute::post( 'challenges/{challenge}/questions', 'App\Http\Controllers\ChallengeController@storeQuestion' );
	APIRoute::get( 'challenges/{challenge}/insights', 'App\Http\Controllers\ChallengeController@showInsights' );
	APIRoute::resource('resources', 'App\Http\Controllers\ResourceController');
	APIRoute::resource('categories', 'App\Http\Controllers\CategoryController');
	APIRoute::resource('questions', 'App\Http\Controllers\QuestionController');
	APIRoute::resource('insights', 'App\Http\Controllers\InsightController');
	APIRoute::resource('events', 'App\Http\Controllers\EventController', ['only' => ['index','show']]);
} );

