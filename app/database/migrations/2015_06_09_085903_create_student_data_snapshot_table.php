<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentDataSnapshotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_data_snapshot', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('course_enrolment');
            $table->integer('english_lang_level');
            $table->integer('payment_info_metadata');
            $table->integer('payment_info');
            $table->integer('contact_information_kin_detail');
            $table->integer('contact_information_online');
            $table->integer('contact_information_tt');
            $table->integer('contact_information_p');
            $table->integer('student');
            $table->integer('bqu_data');
            $table->integer('educational_qualification');
            $table->integer('work_experience');
            $table->integer('source_id');
            $table->integer('application_status');
            $table->integer('source');
            $table->string('san');
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
		Schema::drop('student_data_snapshot');
	}

}
