<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulanceCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulance_calls', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_model')->nullable();
            $table->string('driver_name')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('charge_category')->nullable();
            $table->string('charge_sub_category')->nullable();
            $table->string('charge_name')->nullable();
            $table->string('standard_charges')->nullable();
            $table->string('tax')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('net_amount')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('cheque_document')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('ambulance_calls');
    }
}
