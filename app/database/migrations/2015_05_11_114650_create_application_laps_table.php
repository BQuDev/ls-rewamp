<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationLapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_laps', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('abbreviations');
            $table->string('city');
            $table->string('country');
            $table->string('is_uk_based');
            $table->string('other');
            $table->integer('is_enabled');
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
		Schema::drop('application_laps');
	}

}
