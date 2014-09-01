<?php

class EmployeesController extends \BaseController {
 	
 	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth');

        $this->beforeFilter('role');

        // $this->beforeFilter('prefix', ['/admin']);

        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	/**
	 * Display a listing of all employees.
	 *
	 * @return view with list of all employees
	 */
	public function index()
	{
		return 	View::make('admin.display.employee', array('pageTitle' => 'Manage Employees'))
				->with('employees', Employee::withTrashed()->orderBy('last_name')->get());
	}


	/**
	 * Show the form for adding a new employee.
	 *
	 * @return structure of create employee account form
	 */
	public function create()
	{
		return 	View::make('admin.create.employee', array('pageTitle' => 'Create Employee Account'))
				->with('departments', Department::orderBy('department')->lists('department', 'department_id'));
	}


	/**
	 * Store a newly created resource in accounts employees tables.
	 *
	 * @return redirect to create employee account form with specific return msg
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'username' => 'required|max:20|min:5|unique:accounts',
				'password' => 'required|max:50|min:6',
				'password_again' => 'required|same:password',
				'first_name' => 'required|max:50|min:2',
				'middle_name' => 'required|max:50|min:2',
				'last_name' => 'required|max:50|min:2',
				'email' => 'required|max:50|email|unique:employees',
				'mobile' => 'max:15|min:11',
				'position' => 'required',
				'department' => 'required'
			)
		);

		if($validator->fails()) {
			return 	Redirect::route('employees.create')
					->withErrors($validator)
					->withInput();
		}
		else {
			//Create employee account
			$username 			= Input::get('username');
			$password 			= Input::get('password');
			$first_name 		= Input::get('first_name');
			$middle_name 		= Input::get('middle_name');
			$last_name 			= Input::get('last_name');
			$email 				= Input::get('email');
			$mobile 			= Input::get('mobile');
			$department_id 		= Input::get('department');
			$department_name 	= Department::where('department_id', $department_id)->pluck('department');
			$position 			= Input::get('position');
			$recreate 			= Input::get('recreate');

			// Check first if a department head already exists
			$existingEmployee = Employee::departmentID($department_id)->head()->get();
			if($existingEmployee->count() && $position == 1) {
				if($recreate == 1){
					return $this->createAccount($username, $password, $first_name, $middle_name, $last_name, $email, $mobile, $department_id, $position);
				}
				else {
					$msg = "WARNING: Head employee for " . $department_name . " already exists. To  continue, update password fields and click Save or change employee's position to Member and click Save";
					return 	Redirect::route('employees.create')
							->with('recreate', 1)
							->with('global-error', $msg)
							->withInput();
				}
			}
			else {
				return $this->createAccount($username, $password, $first_name, $middle_name, $last_name, $email, $mobile, $department_id, $position);
			}
		}
	}

	/**
	*
	* createAccount function
	* @param: $uN - username, $pWd - password, $fN - first name, $mN - middle name, $lN - last name
	* $mob - mobile number, $dID - department id, $pos - position 
	* @return redirect to create employee account form with specific return msg
	*
	*/
	public function createAccount($uN, $pWd, $fN, $mN, $lN, $em, $mob, $dID, $pos) {
		//Add to accounts table
		$account = Account::create(array(
			'username' => $uN,
			'password' => Hash::make($pWd)
		));

		//Add to employees table
		$employee = Employee::create(array(
			'username' => $uN,
			'first_name' => $fN,
			'middle_name' => $mN,
			'last_name' => $lN,
			'email' => $em,
			'mobile' => $mob,
			'department_id' => $dID,
			'position' => $pos
		));

		if($account) {
			if($employee) {
				return 	Redirect::route('employees.create')
						->with('global-successful', 'Employee account successfully created!');
			}
			else {
				return 	Redirect::route('employees.create')
					->with('global-error', 'Failed to create employee profile!');
			}
		}
		else {
			return 	Redirect::route('employees.create')
					->with('global', 'Failed to create employee account!');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string  $username
	 * @return Response
	 */
	public function show($username)
	{
		//
	}


	/**
	 * Show the form for editing employee information.
	 *
	 * @param  string  $username
	 * @return Response
	 */
	public function edit($username)
	{
		$employee = Employee::where('username', $username);

		if($employee->count()){
			$employee = $employee->first();

			return 	View::make('admin.edit.employee', array('pageTitle' => 'Edit Employee Information'))
					->with('employee', $employee)
					->with('departments', Department::orderBy('department')->get());
		}

		return App::abort(400);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string  $username
	 * @return Response
	 */
	public function update($username)
	{
		$validator = Validator::make(Input::all(), 
			array(
				'position' => 'required',
				'department' => 'required'
			)
		);

		if($validator->fails()) {
			return 	Redirect::route('employees.edit', $username)
					->withErrors($validator)
					->withInput();
		}
		else {
			//Create employee account
			$department_id 	= Input::get('department');
			$position 	= Input::get('position');

			//Update employee table
			$employee = Employee::where('username', $username)->first();

			$employee->department_id = $department_id;
			$employee->position = $position;

			$return_msg = '';
			$global_type = '';
			if($employee->save()) {
				$global_type = 'global-successful';
				$return_msg = 'Employee account updated!';
			}
			else {
				$global_type = 'global-error';
				$return_msg = 'Failed to update employee account!';
			}

			return 	Redirect::route('employees.edit', $username)
					->with($global_type, $return_msg);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $username
	 * @return Response
	 */
	public function destroy($username)
	{
		$account = Account::where('username', $username)->first();

		$return_msg = '';
		$global_type = '';
		if($account->count()) {
			$account->status = 1;
			$employee_fullname = $account->employee->full_name;

			if($account->save()) {
				$account->delete();
				$global_type = 'global-successful';
				$return_msg = $employee_fullname . ' account deactivated!';
			}
			else {
				$global_type = 'global-error';
				$return_msg = 'Failed to deactivate account of ' . $employee_fullname;
			}
		}
		else {
			$global_type = 'global-error';
			$return_msg = 'Failed to deactivate account';
		}

		return 	Redirect::route('employees.index')
					->with($global_type, $return_msg);
	}


}
