<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathologyBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathology_billings', function (Blueprint $table) {
            $table->id();
            $table->string('billId');
            $table->string('patientId');
            $table->string('total');
            $table->string('extra_charges_name');
            $table->string('extra_charges_value');
            $table->string('total_discount');
            $table->string('discount_type');
            $table->string('total_tax');
            $table->string('grand_total');
            $table->string('discount_status');
            $table->string('test_status');
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
        Schema::dropIfExists('pathology_billings');
    }
}
