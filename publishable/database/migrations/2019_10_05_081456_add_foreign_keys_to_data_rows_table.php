<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDataRowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('data_rows', function(Blueprint $table)
		{
			$table->foreign('data_type_id')->references('id')->on('data_types')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('data_rows', function(Blueprint $table)
		{
			$table->dropForeign('data_rows_data_type_id_foreign');
		});
	}

}
