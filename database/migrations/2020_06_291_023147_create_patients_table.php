<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('code')->nullable();
			$table->string('name')->nullable();
			$table->string('gender')->nullable();
			$table->string('dob')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('address')->nullable();
			$table->softDeletes();
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
		Schema::drop('patients');
	}

}
