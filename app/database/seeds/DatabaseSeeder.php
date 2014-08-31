<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('AccountSeeder');
		$this->call('EmployeeSeeder');
		$this->call('DepartmentSeeder');
		$this->call('ClientSeeder');
	}

}
