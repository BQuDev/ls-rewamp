<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationAgentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_agents', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('abbreviations');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->integer('admission_manager_id');
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
		Schema::drop('application_agents');
	}

}
