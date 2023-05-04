<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFalsePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('false_patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_prefix');
            $table->string('prefix');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('local_guardian_name')->nullable();
            $table->string('local_guardian_contact_no')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact_no')->nullable();
            $table->string('guardian_name_realation')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('pin_no')->nullable();
            $table->string('local_address')->nullable();
            $table->string('country_local')->nullable();
            $table->string('state_local')->nullable();
            $table->string('district_local')->nullable();
            $table->string('local_pin_no')->nullable();
            $table->string('identification_name')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('known_allergies')->nullable();
            $table->string('is_active')->default(1);
            $table->string('is_delete')->default(0);
            $table->string('ins_by')->default('sys');
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
        Schema::dropIfExists('false_patients');
    }
}
