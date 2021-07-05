<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_tests', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('group_id')->nullable();
			$table->integer('test_id')->nullable();
			$table->float('price')->nullable();
			$table->boolean('has_results')->default(0);
			$table->boolean('has_entered')->default(0);
			$table->boolean('done')->default(0);
			$table->longtext('comment')->nullable();
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
		Schema::drop('group_analyses');
	}

}
