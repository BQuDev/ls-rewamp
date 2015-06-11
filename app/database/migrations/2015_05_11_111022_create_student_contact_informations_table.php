<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentContactInformationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_contact_informations', function(Blueprint $table)
		{

            $table->increments('id');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('post_code');
            $table->string('country');
            $table->string('mobile');
            $table->string('landline');
            $table->integer('student_contact_information_type');
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
		Schema::drop('student_contact_informations');
	}

}
