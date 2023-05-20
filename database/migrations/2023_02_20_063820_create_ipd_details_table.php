<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpdDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id');
            $table->string('admitted_by');
            $table->string('admitted_by_contact_no');
            $table->string('ipd_prefix');
            $table->string('patient_source_id');
            $table->string('patient_source');
            $table->string('case_id');
            $table->dateTime('appointment_date');
            $table->string('credit_limit')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulse')->nullable();
            $table->string('temperature')->nullable();
            $table->string('respiration')->nullable();
            $table->string('bp')->nullable();
            $table->string('symptoms')->nullable();
            $table->string('known_allergies')->nullable();
            $table->string('symptoms_type')->nullable();
            $table->longText('symptoms_description')->nullable();
            $table->string('patient_type');
            $table->string('tpa_organization')->nullable();
            $table->string('type_no')->nullable();
            $table->string('note')->nullable();
            $table->string('refference')->nullable();
            $table->string('cons_doctor')->nullable();
            $table->string('department_id')->nullable();
            $table->string('bed')->nullable();
            $table->string('bed_ward_id')->nullable();
            $table->string('bed_unit_id')->nullable();
            $table->string('discharged')->default('no');
            $table->string('discharged_date')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('status')->default('admitted');
            $table->string('ins_by')->default('ori');
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
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
        Schema::dropIfExists('ipd_details');
    }
}
