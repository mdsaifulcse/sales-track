<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_targets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id',false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('target_year','10');
            $table->string('target_months',50);

            $table->float('quarterly_amount',10,2)->default('0');
            $table->float('quarterly_achieve_amount',10,2)->default('0');

            $table->tinyInteger('status',false,1)->default('1')->comment('1=Active, 2=Inactive');
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
        Schema::dropIfExists('assign_targets');
    }
}
