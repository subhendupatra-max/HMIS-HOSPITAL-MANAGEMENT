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
            $table->longText('diagonsis_admission_time');
            $table->longText('final_diagonsis_discharge');
            $table->longText('diagnosis');
            $table->longText('complaiints_duraiton');
            $table->longText('presenting_illness');
            $table->longText('physical_examinaiton_at_admission');
            $table->longText('history_alcoholism');
            $table->longText('medical_surgical_history');
            $table->longText('family_history_diagnosis');
            $table->longText('summary_inves_during_hos');
            $table->longText('course_complications');
            $table->longText('dischage_advice');
            $table->string('doctor_signature');
            $table->string('attendant_signature');
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
