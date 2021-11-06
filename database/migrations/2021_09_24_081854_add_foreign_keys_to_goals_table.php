<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('goals', function(Blueprint $table)
		{
			$table->foreign('id_type', 'goals_Type_goals0_FK')->references('id_type')->on('type_goals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_users', 'goals_users_FK')->references('id_users')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('goals', function(Blueprint $table)
		{
			$table->dropForeign('goals_Type_goals0_FK');
			$table->dropForeign('goals_users_FK');
		});
	}

}
