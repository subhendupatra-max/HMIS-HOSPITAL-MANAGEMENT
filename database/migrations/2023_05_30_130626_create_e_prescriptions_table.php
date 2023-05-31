<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('prescription_date');
            $table->string('patient_id');
            $table->string('section');
            $table->string('case_id');
            $table->string('opd_id');
            $table->string('ipd_id');
            $table->string('emg_id');
            $table->string('note');
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
        Schema::dropIfExists('e_prescriptions');
    }
}
