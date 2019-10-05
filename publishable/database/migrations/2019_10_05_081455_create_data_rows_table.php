<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataRowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_rows', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('data_type_id')->unsigned()->index('data_rows_data_type_id_foreign');
			$table->string('field');
			$table->string('type');
			$table->string('display_name');
			$table->boolean('required')->default(0);
			$table->boolean('browse')->default(1);
			$table->boolean('read')->default(1);
			$table->boolean('edit')->default(1);
			$table->boolean('add')->default(1);
			$table->boolean('delete')->default(1);
			$table->text('details', 65535)->nullable();
			$table->integer('order')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_rows');
	}

}
