<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentWorkExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_work_experiences', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('occupation_1');
            $table->string('company_name_1');
            $table->string('main_duties_1');
            $table->string('occupation_start_date_1');
            $table->string('occupation_end_date_1');
            $table->string('currently_working_1');
            $table->string('occupation_2');
            $table->string('company_name_2');
            $table->string('main_duties_2');
            $table->string('occupation_start_date_2');
            $table->string('occupation_end_date_2');
            $table->string('currently_working_2');
            $table->string('occupation_3');
            $table->string('company_name_3');
            $table->string('main_duties_3');
            $table->string('occupation_start_date_3');
            $table->string('occupation_end_date_3');
            $table->string('currently_working_3');
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
		Schema::drop('student_work_experiences');
	}

}
