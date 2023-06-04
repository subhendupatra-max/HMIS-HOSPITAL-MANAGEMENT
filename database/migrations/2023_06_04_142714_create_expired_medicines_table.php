<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpiredMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expired_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('grm_id')->nullable();
            $table->string('po_details_id')->nullable();
            $table->string('emg_challan_id')->nullable();
            $table->string('stored_room')->nullable();
            $table->string('status')->nullable();
            $table->string('catagory')->nullable();
            $table->string('unit')->nullable();
            $table->string('medicine')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('qty')->nullable();
            $table->string('mrp')->nullable();
            $table->string('discount')->nullable();
            $table->string('p_rate')->nullable();
            $table->string('s_rate')->nullable();
            $table->string('cgst')->nullable();
            $table->string('cgst_value')->nullable();
            $table->string('sgst')->nullable();
            $table->string('sgst_value')->nullable();
            $table->string('igst')->nullable();
            $table->string('igst_value')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('expired_medicines');
    }
}
