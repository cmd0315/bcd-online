<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineFormsTable extends Migration {

	public function up()
	{
		Schema::create('online_forms', function($t) {
			$t->increments('id');
			$t->string('form_num', 50);
			$t->string('category', 250);
			$t->string('created_by', 50);
			$t->string('updated_by', 50);
			$t->integer('stage')->default(0);
			$t->integer('status')->default(0);
			$t->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('online_forms');
	}

}
