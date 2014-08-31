<?php

class AccountsController extends \BaseController {
	/* viewing the signin form */
	public function getSignIn() {
		return View::make('signin', array('pageTitle' => 'Sign In'));
	}

	/* submitting the signin form */
	public function postSignIn() {
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required|max:20|min:5|',
				'password' => 'required'
			)
		);

		if($validator->fails()) {
			//Redirect to signin page
			return 	Redirect::route('accounts.signin')
					->withErrors($validator)
					->withInput();
		}
		else {
			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'status' => 0
			), $remember);

			if($auth){
				//Redirect to intended page
				return Redirect::intended(URL::route('dashboard'));
			}
			else {
				return  Redirect::route('accounts.signin')
						->with('global', 'Wrong username or password');
			}
		}

	}

	/* sign out */
	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home');
	}

}
