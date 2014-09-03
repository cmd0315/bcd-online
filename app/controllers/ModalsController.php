<?php

class ModalsController extends \BaseController {

	/**
	 * Pass to modal the employee's name and the action url for the form
	 *
	 * @return json response containing form action link and employee'ss full name
	 */
	public function getDeactivateEmployee() {
		$username = Input::get('employee-username');
		$employee_name = Employee::where('username', $username)->first()->full_name;
		$action_link = URL::route('employees.destroy', $username);
		$response = array(
            'status' => 'success',
            'full_name' => $employee_name,
            'action_link' => $action_link
        );
 
        return Response::json($response);
	}

}
