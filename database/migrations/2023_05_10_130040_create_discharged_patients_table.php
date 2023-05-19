<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDischargedPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharged_patients', function (Blueprint $table) {
            $table->id();
            $table->string('ipd_id');
            $table->string('patient_id');
            $table->string('case_id');
            $table->string('discharge_date');
            $table->string('discharge_status');
            $table->string('icd_code');
            $table->longText('note');
            $table->longText('operation');
            $table->longText('diagnosis');
            $table->longText('investigation');
            $table->longText('treatment_home');
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
        Schema::dropIfExists('discharged_patients');
    }
}
