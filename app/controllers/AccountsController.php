<?php

class AccountsController extends \BaseController {
	/* viewing the signin form */
	public function getSignIn() {
		return View::make('signin', ['pageTitle' => 'Sign In']);
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

	/**
	 * Show the form for changing password.
	 *
	 * @return view for change password form
	 */
	public function getChangePassword() {
		return 	View::make('account.change-password', ['pageTitle' => 'Change Password']);
	}

	/**
	 * Update account password.
	 *
	 * @return view for change password form
	 */
	public function postChangePassword() {
		$validator = Validator::make(Input::all(), 
			array(
				'old_password' => 'required',
				'password' => 'required|max:50|min:6',
				'password_again' => 'required|same:password'
			) 
		);


		if($validator->fails()) {
			return 	Redirect::route('accounts.change-password')
					->withErrors($validator)
					->withInput();
		}
		else {
			$user 				= Account::find(Auth::user()->id);

			$old_password 		= Input::get('old_password');
			$new_password 		= Input::get('password');

			$return_msg = '';
			$global_type = '';

			if(Hash::check($old_password, $user->getAuthPassword())) {
				$user->password = Hash::make($new_password);

				if($user->save()){
					$global_type = 'global-successful';
					$return_msg = 'Password has been successfully changed!';
				}
			}
			else {
				$global_type = 'global-error';
				$return_msg = 'Old password given does not match record!';
			}

			return  Redirect::route('accounts.change-password')
					->with($global_type, $return_msg);
		}
		return  Redirect::route('accounts.change-password')
				->with('global-error', 'Cannot change password');
	}
}
