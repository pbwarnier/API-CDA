<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMandatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mandats', function(Blueprint $table)
		{
			$table->integer('id_mandates', true);
			$table->string('name', 250);
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('id_clients')->index('mandats_clients_FK');
			$table->integer('id_users')->index('mandats_users0_FK');
			$table->integer('id_documents')->index('mandats_documents1_FK');
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
		Schema::drop('mandats');
	}

}
