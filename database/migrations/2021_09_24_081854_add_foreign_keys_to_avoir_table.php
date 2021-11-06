<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAvoirTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('avoir', function(Blueprint $table)
		{
			$table->foreign('id_appointements', 'avoir_appointements_FK')->references('id_appointements')->on('appointements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_users', 'avoir_users0_FK')->references('id_users')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('avoir', function(Blueprint $table)
		{
			$table->dropForeign('avoir_appointements_FK');
			$table->dropForeign('avoir_users0_FK');
		});
	}

}
