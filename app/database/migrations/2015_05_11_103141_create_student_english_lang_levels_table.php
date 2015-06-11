<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentEnglishLangLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_english_lang_levels', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('english_language_level');
            $table->string('english_language_level_other');
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
		Schema::drop('student_english_lang_levels');
	}

}
