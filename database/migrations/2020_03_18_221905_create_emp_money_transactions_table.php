<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpMoneyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_money_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('emp_expenditure_id',false);
            $table->foreign('emp_expenditure_id')->references('id')->on('emp_expenditures');

            $table->unsignedBigInteger('from_user_id',false);
            $table->foreign('from_user_id')->references('id')->on('users');

            $table->unsignedBigInteger('to_user_id',false);
            $table->foreign('to_user_id')->references('id')->on('users');

            $table->string('details',255)->nullable();

            $table->tinyInteger('transaction_type',false,1)->comment('1=Borrow Repay, 2=Borrow Give');
            $table->tinyInteger('status',false,1)->comment('0=Pending, 1=Approve,2=Reject');
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
        Schema::dropIfExists('emp_money_transactions');
    }
}
