<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name',255)->nullable();
            $table->string('logo',255)->nullable();
            $table->string('favicon',255)->nullable();
            $table->string('address1',255)->nullable();
            $table->string('address2',255)->nullable();
            $table->string('mobile',40)->nullable();
            $table->string('phone',40)->nullable();
            $table->string('email',120)->nullable();
            $table->tinyInteger('type',false,1)->nullable()->comment('1=Group of Company, 2=Single Company');
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
        Schema::dropIfExists('primary_info');
    }
}
