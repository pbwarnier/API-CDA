<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvoirTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avoir', function(Blueprint $table)
		{
			$table->integer('id_appointements');
			$table->integer('id_users')->index('avoir_users0_FK');
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->primary(['id_appointements','id_users']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avoir');
	}

}
