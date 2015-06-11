<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentContactInformationOnlinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_contact_information_onlines', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('email');
            $table->string('alternative_email');
            $table->string('facebook');
            $table->string('linkedin');
            $table->string('twitter');
            $table->string('other_social');
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
		Schema::drop('student_contact_information_onlines');
	}

}
