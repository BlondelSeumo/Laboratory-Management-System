<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupCulturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_cultures', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('group_id')->nullable();
			$table->integer('culture_id')->nullable();
			$table->float('price')->nullable();
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
		Schema::drop('group_cultures');
	}

}
