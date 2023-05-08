<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillSummaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_summary_details', function (Blueprint $table) {
            $table->id();
            $table->string('bill_summary_id')->nullable();
            $table->string('bill_id')->nullable();
            $table->string('from')->nullable();
            $table->string('bill_date')->nullable();
            $table->string('bill_amount')->nullable();
            $table->string('bill_status')->nullable();
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
        Schema::dropIfExists('bill_summary_details');
    }
}
