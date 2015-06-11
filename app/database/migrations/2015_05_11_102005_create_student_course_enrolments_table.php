<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentCourseEnrolmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_course_enrolments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('course_name');
            $table->string('course_level');
            $table->integer('awarding_body');
            $table->string('intake');
            $table->string('study_mode');
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
		Schema::drop('student_course_enrolments');
	}

}
