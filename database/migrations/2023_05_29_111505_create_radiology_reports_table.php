<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiology_reports', function (Blueprint $table) {
            $table->id();
            $table->string('radiology_patient_test_id')->nullable();
            $table->string('parameter_id')->nullable();
            $table->string('reference_range')->nullable();
            $table->string('unit')->nullable();
            $table->string('report_value')->nullable();
            $table->string('parameter_description')->nullable();
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
        Schema::dropIfExists('radiology_reports');
    }
}
