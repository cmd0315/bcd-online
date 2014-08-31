<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

	public function up()
	{
		Schema::create('departments', function($t) {
			$t->increments('id');
			$t->string('department_id', 50);
			$t->string('department', 80);
			$t->integer('status')->default(0);
			$t->timestamps();
			$t->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('departments');
	}

}
