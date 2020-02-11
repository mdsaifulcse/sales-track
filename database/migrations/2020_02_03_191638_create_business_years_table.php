<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_years', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year_name','150')->unique();
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
        Schema::dropIfExists('business_years');
    }
}
