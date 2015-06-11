<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentContactInformationKinDetailesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_contact_information_kin_detailes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('next_of_kin_title');
            $table->string('next_of_kin_forename');
            $table->string('next_of_kin_surname');
            $table->string('next_of_kin_telephone');
            $table->string('next_of_kin_email');
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
		Schema::drop('student_contact_information_kin_detailes');
	}

}
