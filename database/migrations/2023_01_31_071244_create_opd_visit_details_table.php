<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpdVisitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_visit_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('opd_details_id');
            $table->integer('department_id');
            $table->integer('cons_doctor');
            $table->string('unit');
            $table->string('visit_type');
            $table->bigInteger('ticket_no');
            $table->bigInteger('ticket_fees');
            $table->string('case_type')->nullable();
            $table->dateTime('appointment_date');
            $table->string('patient_type');
            $table->string('tpa_organization')->nullable();
            $table->string('type_no')->nullable();
            $table->string('symptoms_type')->nullable();
            $table->string('symptoms')->nullable();
            $table->longText('symptoms_description')->nullable();
            $table->string('bp')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulse')->nullable();
            $table->string('temperature')->nullable();
            $table->string('respiration')->nullable();
            $table->string('known_allergies')->nullable();
            $table->string('refference')->nullable();
            $table->longText('note')->nullable();
            $table->integer('generated_by');
            $table->string('ins_by')->default('ori');
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
        Schema::dropIfExists('opd_visit_details');
    }
}
