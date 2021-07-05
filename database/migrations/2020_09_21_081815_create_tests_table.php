<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tests', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('parent_id')->nullable();
			$table->string('name')->nullable();
			$table->string('shortcut')->nullable();
			$table->string('sample_type')->nullable();
			$table->string('unit')->nullable();
			$table->text('reference_range')->nullable();
			$table->text('type')->bullable();
			$table->boolean('separated')->default(0);
			$table->double('price')->default(0);
			$table->boolean('status')->default(0);
			$table->boolean('title', 1)->nullable()->default(0);
			$table->text('precautions')->nullable();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('analyses');
	}

}
