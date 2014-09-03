<?php

class DepartmentsController extends \BaseController {

	/**
	 * Display a listing of all departments.
	 *
	 * @return view displaying list of all created departments
	 */
	public function index($sortBy = null)
	{
		$departments = "";

		$search_data = (isset($_GET['search-data'])) ? $_GET['search-data'] : "";

		if(($search_data !== "") && (strcasecmp($search_data, "all") > 0)) {
			$department_name = $search_data;
			$departments = Department::where('department', 'like' , '%' . $department_name . '%');
		}
		else{
			if($sortBy == "created_at"){
				$departments = Department::orderBy('created_at', 'DESC');
			}
			else {
				$departments = Department::orderBy('department');
			}
		}
		return 	View::make('admin.display-list.department', array('pageTitle' => 'Manage Departments'))
				->with('departments', $departments->withTrashed()->paginate(5));
	}


	/**
	 * Show the form for adding a department.
	 *
	 * @return view of add department form
	 */
	public function create()
	{
		$generated_id = $this->generateDepartmentID();
		return View::make('admin.create.department', ['pageTitle' => 'Add Department', 'generatedID' => $generated_id]);
	}


	/**
	 * Store a newly created resource in departments table
	 *
	 * @return view for add department form with corresponsing response if successful or not
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),
			array(
				'department' => 'required|max:20|min:2|unique:departments'
			)
		);

		if($validator->fails()) {
			//Redirect to signin page
			return 	Redirect::route('employees.create')
					->withErrors($validator)
					->withInput();
		}
		else {
			//Create department
			$department_id 	= Input::get('department_id');
			$department_name 	= Input::get('department');

			//Add to departments table
			$department = Department::create(array(
				'department_id' => $department_id,
				'department' => $department_name
			));

			if($department) {
				return 	Redirect::route('departments.create')
						->with('global-successful', 'Department Added!');
			}
			else {
					return 	Redirect::route('departments.create')
							->with('global-error', 'Failed to add department');
			}
		}

		return 	Redirect::route('departments.create')
				->with('global-error', 'Failed to add department');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing department information.
	 *
	 * @param  String  $id
	 * @return view of edit department form
	 */
	public function edit($id)
	{
		$department = Department::where('department_id', $id)->first();
		$department_head_username = $this->getHeadEmployeeUsername($id);

		$dept_members = Employee::where('department_id', $id)->get();

		return 	View::make('admin.edit.department', ['pageTitle' => 'Edit Department Information'])
				->with('department', $department)
				->with('departmentHeadUsername', $department_head_username)
				->with('employees', Employee::where('department_id', $id)->get())
				->with('dept_members', $dept_members);
	}


	/**
	 * Update department information with PATCH request.
	 *
	 * @param  String  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(),
			array(
				'department' => 'required|max:20|min:2'
			)
		);

		if($validator->fails()) {
			return 	Redirect::route('departments.edit', $id)
					->withErrors($validator)
					->withInput();
		}
		else {
			$department_name 	= Input::get('department');
			$employee_username	= Input::get('department_head');

			//Get department
			$department_name_exists = Department::where('department_id', '!=', $id)->where('department', $department_name)->first();
			$department = Department::where('department_id', $id)->first();

			$return_msg = '';
			$global_type = '';

			if($department->count() && !($department_name_exists)) {
				$department->department = $department_name;

				//check if saving department details is successful
				if($department->save()){

					//check if there's already an existing department head
					$head_employee_exists = Employee::where('department_id', $id)->where('position', 1)->first();
					if($head_employee_exists) {
						$head_employee_exists->position = 0;
						$head_employee_exists->save();
					}

					//check if there's an input for employee name
					$employee = Employee::where('username', $employee_username)->first();
					if($employee) {
						$employee->position = 1;
						$employee->department_id = $id;

						//check if saving employee data is successful
						if($employee->save()) {
							$global_type = 'global-successful';
							$return_msg ="Department information is updated!";
						}
						else{
							$global_type = 'global-error';
							$return_msg = "Failed to update department information! Error on updating position of head employee";
						}
					}
					else {
						$global_type = 'global-successful';
						$return_msg ="Department information is updated!";
					}
				}
				else {
					$global_type = 'global-error';
					$return_msg = "Failed to update department information! Error on saving the changes.";
				}
			}
			else {
				$global_type = 'global-error';
				$return_msg = 'Failed to update the department information! Error on finding the department or department with similar name already exists!';
			}

			return 	Redirect::route('departments.edit', $id)
					->with($global_type, $return_msg);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  String  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$department = Department::where('department_id', $id)->first();

		$return_msg = '';
		$global_type = '';
		if($department->count()) {
			$department->status = 1;
			$department_name = $department->department;

			if($department->save()) {
				$department->delete();
				$global_type = 'global-successful';
				$return_msg = $department_name . ' department account deactivated!';
			}
			else {
				$global_type = 'global-error';
				$return_msg = 'Failed to deactivate account of ' . $department_name . ' department';
			}
		}
		else {
			$global_type = 'global-error';
			$return_msg = 'Failed to deactivate department account';
		}

		return 	Redirect::route('departments.index')
					->with($global_type, $return_msg);
	}




	public function generateDepartmentID() {
		$generated_id = "D-" . strtoupper(RandomNumberGenerator::generateRandomString(4));

		$department_exists = Department::where('department_id', $generated_id)->get();

		if($department_exists->count()) {
			generateDepartmentID();
		}
		else{
			return $generated_id;
		}
	}


	/**
	 * getHeadEmployeeUsername
	 *
	 * @param  String  $id
	 * @return username of employee with position as head given the department $id
	 */
    public function getHeadEmployeeUsername($id) {
    	$employee = Employee::departmentID($id)->head()->first();

    	if($employee){
    		$employee_id = e($employee->username);
    		return $employee_id;
    	}
    	else {
    		return "";
    	}
    }
}
