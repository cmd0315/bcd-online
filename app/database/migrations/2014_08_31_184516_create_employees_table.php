<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {
	
	public function up()
	{
		Schema::create('employees', function($t) {
			$t->increments('id');
			$t->string('username', 20);
			$t->string('first_name', 50);
			$t->string('middle_name', 50);
			$t->string('last_name', 50);
			$t->string('email', 50);
			$t->string('mobile', 15);
			$t->string('department_id', 10);
			$t->integer('position');
		});
	}

	public function down()
	{
		Schema::drop('employees');
	}

}
