<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('branch_id')->nullable()->unsigned();
			$table->integer('patient_id')->nullable();
			$table->integer('doctor_id')->nullable();
			$table->integer('contract_id')->nullable();
			$table->float('discount')->default(0);
			$table->float('subtotal')->default(0);
			$table->float('total')->default(0);
			$table->float('paid')->default(0);
			$table->float('due')->default(0);
			$table->boolean('done')->default(0);
			$table->text('report_pdf')->nullable();
			$table->text('receipt_pdf')->nullable();
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
		Schema::drop('groups');
	}

}
