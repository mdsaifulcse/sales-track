<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_visit_id');
            $table->foreign('company_visit_id')->references('id')->on('company_visits');

            $table->date('follow_date');
            $table->string('contact_name',200)->nullable();
            $table->string('contact_mobile',50)->nullable();
            $table->string('contact_email',150)->nullable();
            $table->text('discussion_summery')->nullable();
            $table->tinyInteger('status',false,1)->comment('1=Follow Up Need, 2=No Need Follow Up,3=Need Quotation,4=Quotation Submitted, 5=Fail to sale,6=Success to Sale')->default(1);
            $table->string('status_reason')->nullable();

            $table->text('existing_system_details')->nullable();
            $table->text('competitor_details')->nullable();
            $table->float('quotation_value',10,2)->comment('Quotation value will be Sale value when complete sale')->default(0);

            $table->unsignedBigInteger('follow_up_by');
            $table->foreign('follow_up_by')->references('id')->on('users');

            $table->tinyInteger('follow_up_step',false,2)->comment('1=First Visit, 2=Follow Up')->default(2);


            $table->unsignedBigInteger('associate_by')->nullable();
            $table->foreign('associate_by')->references('id')->on('users');
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
        Schema::dropIfExists('follow_ups');
    }
}
