<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentSourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_sources', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('app_date');
            $table->string('ams_date');
            $table->string('source');
            $table->string('agent_lap');
            $table->string('agents_laps_other');
            $table->string('admission_manager');
            $table->string('admission_managers_other');
            $table->string('san');
            $table->integer('amendment');
            $table->integer('created_by');
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
		Schema::drop('student_sources');
	}

}
