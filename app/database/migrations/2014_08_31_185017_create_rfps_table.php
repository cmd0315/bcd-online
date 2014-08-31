<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfpsTable extends Migration {
	
	public function up()
	{
		Schema::create('rfps', function($t) {
			$t->increments('id');
			$t->string('form_num', 10);
			$t->string('control_num', 30)->nullable();
			$t->string('payee', 250);
			$t->dateTime('date_requested');
			$t->text('particulars');
			$t->double('total_amount', 15, 8);
			$t->string('client', 100);
			$t->integer('check_num');
			$t->string('requested_by', 250);
			$t->string('department_id', 50);
			$t->dateTime('date_needed')->nullable();
			$t->string('received_by', 250)->nullable();
			$t->string('approved_by', 250)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('rfps');
	}

}
