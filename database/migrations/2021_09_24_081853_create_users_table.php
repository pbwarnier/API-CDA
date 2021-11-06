<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id_users', true);
			$table->string('lastname', 50);
			$table->string('firstname', 50);
			$table->string('email', 100);
			$table->char('password', 60);
			$table->string('phone', 15)->nullable();
			$table->char('token', 60)->nullable();
			$table->integer('id_role')->index('users_roles_FK');
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
		Schema::drop('users');
	}

}
