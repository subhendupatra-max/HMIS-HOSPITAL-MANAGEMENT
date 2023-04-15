<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_prefix');
            $table->string('prefix');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('local_guardian_name');
            $table->string('local_guardian_contact_no');
            $table->string('guardian_name');
            $table->string('guardian_name_realation');
            $table->string('marital_status');
            $table->string('blood_group')->nullable();
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('year');
            $table->string('month');
            $table->string('day');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('state');
            $table->string('district');
            $table->string('pin_no');
            $table->string('identification_name')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('known_allergies')->nullable();
            $table->string('is_active')->default(1);
            $table->string('is_delete')->default(0);
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
        Schema::dropIfExists('patients');
    }
}
