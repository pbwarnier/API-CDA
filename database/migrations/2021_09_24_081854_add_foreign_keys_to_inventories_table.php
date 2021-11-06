<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventories', function(Blueprint $table)
		{
			$table->foreign('id_client_buyer', 'inventories_clients1_FK')->references('id_clients')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_client_seller', 'inventories_clients2_FK')->references('id_clients')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_documents', 'inventories_documents3_FK')->references('id_documents')->on('documents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_properties', 'inventories_properties0_FK')->references('id_properties')->on('properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_users', 'inventories_users_FK')->references('id_users')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inventories', function(Blueprint $table)
		{
			$table->dropForeign('inventories_clients1_FK');
			$table->dropForeign('inventories_clients2_FK');
			$table->dropForeign('inventories_documents3_FK');
			$table->dropForeign('inventories_properties0_FK');
			$table->dropForeign('inventories_users_FK');
		});
	}

}
