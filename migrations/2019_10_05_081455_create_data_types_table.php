<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('slug')->unique();
			$table->string('display_name_singular');
			$table->string('display_name_plural');
			$table->string('icon')->nullable();
			$table->string('model_name')->nullable();
			$table->string('policy_name')->nullable();
			$table->string('controller')->nullable();
			$table->string('description')->nullable();
			$table->boolean('generate_permissions')->default(0);
			$table->boolean('server_side')->default(0);
			$table->text('details', 65535)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_types');
	}

}
