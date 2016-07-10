<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendlyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('friendly', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->string('link', 255);
			$table->string('type', 128);
			$table->enum('status', array('deleted', 'active'))->default('active');
			// $table->dateTime('updated_at');
			// $table->dateTime('updated_at');
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
		Schema::drop('friendly');
	}

}
