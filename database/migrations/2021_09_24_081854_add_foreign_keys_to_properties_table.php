<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('properties', function(Blueprint $table)
		{
			$table->foreign('id_clients', 'properties_clients0_FK')->references('id_clients')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_users', 'properties_users_FK')->references('id_users')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('properties', function(Blueprint $table)
		{
			$table->dropForeign('properties_clients0_FK');
			$table->dropForeign('properties_users_FK');
		});
	}

}
