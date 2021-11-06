<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pictures', function(Blueprint $table)
		{
			$table->integer('id_pictures', true);
			$table->string('name', 250);
			$table->string('extension', 10);
			$table->integer('id_documents')->nullable()->index('pictures_documents_FK');
			$table->integer('id_inventories')->nullable()->index('pictures_inventories0_FK');
			$table->integer('id_properties')->nullable()->index('pictures_properties1_FK');
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
		Schema::drop('pictures');
	}

}
