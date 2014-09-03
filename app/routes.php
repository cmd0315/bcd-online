<?php
//Route to home page
Route::get('/', ['as' => 'home','uses' => 'HomeController@getIndex']);


//Routes resources for EmployeesController
Route::resource('employees', 'EmployeesController');

Route::resource('departments', 'DepartmentsController');
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
		/*
		/ Account Password (POST)
		*/
		Route::post('/change-password', array(
			'as' => 'accounts.change-password-post',
			'uses' => 'AccountsController@postChangePassword'
		));
		
	});

	/*
	*
	* System Admin group
	*
	*/
	Route::group(array('before' => 'role'), function() {

		Route::group(array('prefix' => '/admin'), function() {
			/*
			/ System Records (GET)
			*/
			Route::get('/system-records', array(
				'as' => 'system-records',
				'uses' => 'HomeController@getSystemRecordsPage'
			));

		Route::get('/employees/deactivate', array(
			'as' => 'modals.getDeactivateEmployee', 
			'uses' => 'ModalsController@getDeactivateEmployee'
		));
		});
	});

	/*
	/ Signin (GET)
	*/
	Route::get('/dashboard', array(
		'as' => 'dashboard',
		'uses' => 'HomeController@getDashboardPage'
	));

	/*
	/ Sign out (GET)
	*/
	Route::get('/sign-out', array(
		'as' => 'accounts.signout',
		'uses' => 'AccountsController@getSignOut'
	));

	/*
	/ Account Password (GET)
	*/
	Route::get('/change-password', array(
		'as' => 'accounts.change-password',
		'uses' => 'AccountsController@getChangePassword'
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