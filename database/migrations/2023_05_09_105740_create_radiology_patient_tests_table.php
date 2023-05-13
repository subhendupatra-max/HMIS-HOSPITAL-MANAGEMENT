<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologyPatientTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiology_patient_tests', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id')->nullable();
            $table->string('case_id')->nullable();
            $table->string('date')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('section')->nullable();
            $table->string('opd_id')->nullable();
            $table->string('emg_id')->nullable();
            $table->string('ipd_id')->nullable();
            $table->string('test_id')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('billing_status')->nullable();
            $table->longText('test_status')->nullable();
            $table->string('ins_by')->default('ori');
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
        Schema::dropIfExists('radiology_patient_tests');
    }
}
