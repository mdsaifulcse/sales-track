<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_visits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('category_id',false);
            $table->foreign('category_id')->references('id')->on('categories');

            $table->string('product_name')->nullable();
            $table->string('product_doc_file')->nullable();
            $table->string('visited_company');
            $table->string('visited_company_address');
            $table->tinyInteger('status',false,1)->comment('1=Follow Up Need, 2=No Need Follow Up,3=Need Quotation,4=Quotation Submitted, 5=Fail to sale,6=Success to Sale')->default(1);
            $table->float('quotation_value',10,2)->comment('Quotation value will be Sale value when complete sale')->default(0);
            $table->float('profit_value',10,2)->default(0);
            $table->float('profit_percent',4,2)->default(0);
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
        Schema::dropIfExists('company_visits');
    }
}
