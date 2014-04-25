<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('prefix' => '/'), function()
{
	Route::get('/', 'HomeController@index');
	Route::get('post/{year}/{month}/{day}/{slug}', 'HomeController@show');

	Route::group(array('prefix' => 'admin'), function()
	{
		Route::get('login', array(
			'as' => 'admin.login',
			'uses' => 'AdminController@login'
		));
		Route::patch('check', array(
			'as' => 'admin.check',
			'uses' => 'AdminController@check'
		));
	});
});

Route::group(array('prefix' => '/', 'before' => 'auth'), function()
{
	Route::get('new', array(
		'as' => 'home.new',
		'uses' => 'HomeController@create'
	));

	Route::patch('verify', array(
		'as' => 'home.store',
		'uses' => 'HomeController@store'
	));

	Route::post('verify', 'HomeController@postVerify');
	
	Route::get('post/{slug}/delete', array(
		'as' => 'home.destroy',
		'uses' => 'HomeController@destroy'
	));

	Route::get('post/{slug}/edit', array(
		'as' => 'home.show',
		'uses' => 'HomeController@edit'
	));

	Route::patch('post/{slug}/edit', array(
		'as' => 'home.update',
		'uses' => 'HomeController@update'
	));

	Route::group(array('prefix' => 'admin'), function()
	{
		Route::get('logout', array(
			'as' => 'admin.logout',
			'uses' => 'AdminController@logout'
		));
	});
});

Route::group(array('prefix' => 'users'), function()
{
	Route::get('list', function()
	{
		$users = User::all();
		dd($users);
	});
});