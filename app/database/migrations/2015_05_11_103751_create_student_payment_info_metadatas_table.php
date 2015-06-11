<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentPaymentInfoMetadatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_payment_info_metadatas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('course_fees');
            $table->string('payment_status');
            $table->string('total_fee');
            $table->string('late_admin_fee');
            $table->string('late_fee');
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
		Schema::drop('student_payment_info_metadatas');
	}

}
