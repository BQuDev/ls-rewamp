<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentEducationalQualificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_educational_qualifications', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('qualification_1');
            $table->string('qualification_other_1');
            $table->string('institution_1');
            $table->string('qualification_start_date_1');
            $table->string('qualification_end_date_1');
            $table->string('qualification_grade_1');
            $table->string('qualification_2');
            $table->string('qualification_other_2');
            $table->string('institution_2');
            $table->string('qualification_start_date_2');
            $table->string('qualification_end_date_2');
            $table->string('qualification_grade_2');
            $table->string('qualification_3');
            $table->string('qualification_other_3');
            $table->string('institution_3');
            $table->string('qualification_start_date_3');
            $table->string('qualification_end_date_3');
            $table->string('qualification_grade_3');
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
		Schema::drop('student_educational_qualifications');
	}

}
