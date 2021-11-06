<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table)
		{
			$table->integer('id_properties', true);
			$table->string('name', 50);
			$table->float('price', 10, 0);
			$table->char('reference', 15);
			$table->integer('nb_room');
			$table->text('description', 65535);
			$table->float('area', 10, 0);
			$table->string('type', 50);
			$table->float('rental_expenses', 10, 0)->nullable();
			$table->boolean('availability');
			$table->string('country', 50);
			$table->string('zip_code', 50);
			$table->string('city', 50);
			$table->string('adress', 250);
			$table->boolean('furniture');
			$table->boolean('garage');
			$table->boolean('garden');
			$table->string('energy_class', 2);
			$table->integer('id_users')->index('properties_users_FK');
			$table->integer('id_clients')->index('properties_clients0_FK');
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
		Schema::drop('properties');
	}

}
