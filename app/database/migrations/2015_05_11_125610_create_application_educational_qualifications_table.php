<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationEducationalQualificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('application_educational_qualifications', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('aru');
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
		Schema::drop('application_educational_qualifications');
	}

}
