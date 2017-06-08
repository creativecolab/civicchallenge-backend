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

Route::get( '/', function () {
	return view( 'welcome' );
} );

Route::get( 'login', 'Auth\LoginController@redirectToProvider' );
Route::get( 'login/callback', 'Auth\LoginController@handleProviderCallback' );

Route::group( [
	'prefix'     => config( 'backpack.base.route_prefix', 'admin' ),
	'namespace'  => 'Admin'
], function () {
	Route::get( 'login', 'LoginController@adminRedirectToProvider' );
	Route::get( 'login/callback', 'LoginController@adminHandleProviderCallback' );

	Route::group( ['middleware' => ['admin', 'adminOnly']], function() {
		CRUD::resource( 'category', 'CategoryCrudController' );
		CRUD::resource( 'challenge', 'ChallengeCrudController' );
		CRUD::resource( 'insight', 'InsightCrudController' );
		CRUD::resource( 'question', 'QuestionCrudController' );
		CRUD::resource( 'resource', 'ResourceCrudController' );
		CRUD::resource( 'user', 'UserCrudController' );
	});
} );

Route::group(
	['prefix' => 'admin', 'middleware' => ['admin', 'adminOnly']],
	function() {
		Route::get('/', '\Backpack\Base\app\Http\Controllers\AdminController@redirect');
		Route::get('dashboard', '\Backpack\Base\app\Http\Controllers\AdminController@dashboard');
	}
);