<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventories', function(Blueprint $table)
		{
			$table->integer('id_inventories', true);
			$table->date('date');
			$table->text('data', 65535);
			$table->integer('id_users')->index('inventories_users_FK');
			$table->integer('id_properties')->index('inventories_properties0_FK');
			$table->integer('id_client_buyer')->index('client_buyer_FK');
			$table->integer('id_client_seller')->index('client_seller_FK');
			$table->integer('id_documents')->index('inventories_documents3_FK');
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
		Schema::drop('inventories');
	}

}
