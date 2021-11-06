<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pictures', function(Blueprint $table)
		{
			$table->foreign('id_documents', 'pictures_documents_FK')->references('id_documents')->on('documents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_inventories', 'pictures_inventories0_FK')->references('id_inventories')->on('inventories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_properties', 'pictures_properties1_FK')->references('id_properties')->on('properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pictures', function(Blueprint $table)
		{
			$table->dropForeign('pictures_documents_FK');
			$table->dropForeign('pictures_inventories0_FK');
			$table->dropForeign('pictures_properties1_FK');
		});
	}

}
