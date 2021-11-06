<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointements', function(Blueprint $table)
		{
			$table->integer('id_appointements', true);
			$table->string('title', 50);
			$table->date('date')->nullable();
			$table->integer('user_id')->nullable()->index('FK_appointements_users');
			$table->text('description', 65535);
			$table->date('created_at');
			$table->date('updated_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('appointements');
	}

}
