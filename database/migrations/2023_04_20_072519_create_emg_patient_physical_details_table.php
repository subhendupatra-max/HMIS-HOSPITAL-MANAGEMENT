<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmgPatientPhysicalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emg_patient_physical_details', function (Blueprint $table) {
            $table->id();
            $table->string('emg_id');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulse')->nullable();
            $table->string('bp')->nullable();
            $table->string('temperature')->nullable();
            $table->string('respiration')->nullable();
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
        Schema::dropIfExists('emg_patient_physical_details');
    }
}
