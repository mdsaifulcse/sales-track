<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_expenditures', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id',false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('expenditure_date');
            $table->tinyInteger('purpose',false,1);
            $table->float('amount',11,2);
            $table->string('phone_bill_trxid',200)->nullable()->comment('When purpose is phone bill this field is required');
            $table->string('miscellaneous',250)->nullable()->comment('When purpose is Miscellaneous this field is required');
            $table->string('restaurant_name',255)->nullable()->comment('When Foreigner Launch,Dinner,Breakfast');
            $table->string('docs_img',255)->nullable();

            $table->tinyInteger('status',false,1)->default('1')->comment('1=Active, 0=Inactive');
            $table->author();
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
        Schema::dropIfExists('emp_expenditures');
    }
}
