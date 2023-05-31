<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEPrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_prescription_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('e_prescriptions_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('case_id')->nullable();
            $table->string('medicine_category_id')->nullable();
            $table->string('medicine_id')->nullable();
            $table->string('dose')->nullable();
            $table->string('interval')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('e_prescription_medicines');
    }
}
