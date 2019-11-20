<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id',false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('nid')->nullable();
            $table->timestamp('joining_date')->nullable();
            $table->timestamp('release_date')->nullable();
            $table->integer('salary',false,6)->default(0);

            $table->unsignedBigInteger('designation_id',false);
            $table->foreign('designation_id')->references('id')->on('designations');

            $table->unsignedBigInteger('district_id',false)->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->unsignedBigInteger('thana_upazila_id',false)->nullable();
            $table->foreign('thana_upazila_id')->references('id')->on('thana_upazilas');

            $table->tinyInteger('status',false,1)->default(1)->comment('1=Active, 0=Inactive');
            $table->tinyInteger('serial_num',false,4)->default(0);

            $table->unsignedBigInteger('subordinate',false)->nullable();
            $table->foreign('subordinate')->references('id')->on('users');
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
        Schema::dropIfExists('user_infos');
    }
}
