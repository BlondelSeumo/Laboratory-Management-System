<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupCultureResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_culture_results', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('group_culture_id')->nullable();
			$table->integer('antibiotic_id')->nullable();
			$table->string('sensitivity')->nullable();
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
		Schema::drop('group_culture_results');
	}

}
