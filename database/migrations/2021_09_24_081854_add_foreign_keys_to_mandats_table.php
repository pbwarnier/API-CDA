<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMandatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mandats', function(Blueprint $table)
		{
			$table->foreign('id_clients', 'mandats_clients_FK')->references('id_clients')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_documents', 'mandats_documents1_FK')->references('id_documents')->on('documents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_users', 'mandats_users0_FK')->references('id_users')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mandats', function(Blueprint $table)
		{
			$table->dropForeign('mandats_clients_FK');
			$table->dropForeign('mandats_documents1_FK');
			$table->dropForeign('mandats_users0_FK');
		});
	}

}
