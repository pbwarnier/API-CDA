<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->integer('id_clients', true);
			$table->string('lastname', 30);
			$table->string('firstname', 30);
			$table->string('email', 100);
			$table->string('adress', 250);
			$table->string('phone', 15);
			$table->text('comment', 65535)->nullable();
			$table->integer('type');
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}
