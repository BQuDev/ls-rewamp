<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentPaymentInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_payment_infos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('deposit');
            $table->string('deposit_date');
            $table->integer('deposit_method');
            $table->string('installment_1');
            $table->string('installment_1_date');
            $table->integer('installment_1_method');
            $table->string('installment_2');
            $table->string('installment_2_date');
            $table->integer('installment_2_method');
            $table->string('installment_3');
            $table->string('installment_3_date');
            $table->integer('installment_3_method');
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
		Schema::drop('student_payment_infos');
	}

}
