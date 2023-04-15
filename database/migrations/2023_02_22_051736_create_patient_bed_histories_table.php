<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBedHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_bed_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id');
            $table->bigInteger('case_id');
            $table->bigInteger('ipd_id');
            $table->bigInteger('department_id');
            $table->bigInteger('bed_ward_id');
            $table->bigInteger('bed_unit_id');
            $table->bigInteger('bed_id');
            $table->dateTime('from_date');
            $table->dateTime('to_date')->nullable();
            $table->string('is_present')->default('yes');
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
        Schema::dropIfExists('patient_bed_histories');
    }
}
