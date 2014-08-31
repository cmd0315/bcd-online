<?php
Route::get('/', ['as' => 'home','uses' => 'HomeController@getIndex']);

/*
*
* Auuthenticated group
*
*/
Route::group(array('before' => 'auth'), function(){
	/*
	/ CSRF group
	*/
	Route::group(array('before' => 'csrf'), function(){

	});

	/*
	/ Signin (GET)
	*/
	Route::get('/dashboard', array(
		'as' => 'dashboard',
		'uses' => 'HomeController@getDashboard'
	));

	/*
	/ Sign out (GET)
	*/
	Route::get('/sign-out', array(
		'as' => 'accounts.signout',
		'uses' => 'AccountsController@getSignOut'
	));
});

/*
*
* Unauthenticated group
*
*/
Route::group(array('before' => 'guest'), function(){
	/*
	/ CSRF group
	*/
	Route::group(array('before' => 'csrf'), function(){

		/*
		/ Signin (POST)
		*/
		Route::post('/sign-in', array(
			'as' => 'accounts.signin-post',
			'uses' => 'AccountsController@postSignIn'
		));
			
	});

	/*
	/ Signin (GET)
	*/
	Route::get('/sign-in', array(
		'as' => 'accounts.signin',
		'uses' => 'AccountsController@getSignIn'
	));
});