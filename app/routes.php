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
	Route::get('post/{year}/{month}/{day}/{slug}', array(
		'as' => 'home.show',
		'uses' => 'HomeController@show'
	));

	Route::group(array('prefix' => 'admin'), function()
	{
		Route::get('/', array(
			'as' => 'admin.index',
			'uses' => 'AdminController@index'
		));
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

Route::group(array('prefix' => '/', 'before' => array('auth')), function()
{
	Route::patch('post/comment', array(
		'as' => 'comment.store',
		'uses' => 'CommentController@store'
	));

	Route::group(array('prefix' => 'admin'), function()
	{
		Route::get('logout', array(
			'as' => 'admin.logout',
			'uses' => 'AdminController@logout'
		));
	});

	Route::group(array('before' => array('admin')), function()
	{
		Route::get('post/new', array(
			'as' => 'home.new',
			'uses' => 'HomeController@create'
		));

		Route::patch('post/verify', array(
			'as' => 'home.store',
			'uses' => 'HomeController@store'
		));
		
		Route::delete('post/{year}/{month}/{day}/{slug}', array(
			'as' => 'home.destroy',
			'uses' => 'HomeController@destroy'
		));

		Route::get('post/{year}/{month}/{day}/{slug}/edit', array(
			'as' => 'home.edit',
			'uses' => 'HomeController@edit'
		));

		Route::patch('post/{year}/{month}/{day}/{slug}/edit', array(
			'as' => 'home.update',
			'uses' => 'HomeController@update'
		));

		Route::delete('post/comment/delete/{id}', array(
			'as' => 'comment.destroy',
			'uses' => 'CommentController@destroy'
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