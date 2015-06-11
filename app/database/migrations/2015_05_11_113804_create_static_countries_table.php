<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaticCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('static_countries', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('aru_code');
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
		Schema::drop('static_countries');
	}

}
