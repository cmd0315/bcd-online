<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function($t) {
			$t->increments('id');
			$t->string('client_id', 10);
			$t->string('client_name', 250);
			$t->integer('status')->default(0);
			$t->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}

}
