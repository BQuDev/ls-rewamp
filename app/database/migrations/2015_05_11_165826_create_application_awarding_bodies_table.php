<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationAwardingBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_awarding_bodies', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('acronym');
            $table->string('type');
            $table->string('status');
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
		Schema::drop('application_awarding_bodies');
	}

}
