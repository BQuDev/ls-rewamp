<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationIntakesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_intakes', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('entry_month');
            $table->string('name');
            $table->string('end_date');
            $table->string('transcript_date');
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
		Schema::drop('application_intakes');
	}

}
