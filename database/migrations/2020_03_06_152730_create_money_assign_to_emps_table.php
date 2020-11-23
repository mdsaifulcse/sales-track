<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyAssignToEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_assign_to_emps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id',false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('assign_date');
            $table->string('purpose')->nullable();
            $table->float('amount',11,2);
            $table->string('restaurant_name',255)->nullable();
            $table->string('car_maintenance_details',255)->nullable();
            $table->string('gasoline_details',255)->nullable();
            $table->string('driver_over_time_details',255)->nullable();
            $table->string('docs_img',255)->nullable();

            $table->string('type',30)->default('for_expenditure')->comment('salary, borrow,repay,for_expenditure');
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
        Schema::dropIfExists('money_assign_to_emps');
    }
}
