<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fk_menu_id',false,20);
            $table->bigInteger('fk_sub_menu_id',false,20);
            $table->foreign('fk_menu_id')->references('id')->on('menu');
            $table->foreign('fk_sub_menu_id')->references('id')->on('sub_menu');
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('url');
            $table->string('icon_class')->nullable();
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->string('big_icon')->nullable();
            $table->tinyInteger('status',false,1)->default(1);
            $table->tinyInteger('serial_num',false,4);
            $table->tinyInteger('type',false,1)->nullable('1=Admin,2=user,3=frontend');
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
        Schema::dropIfExists('sub_sub_menu');
    }
}
