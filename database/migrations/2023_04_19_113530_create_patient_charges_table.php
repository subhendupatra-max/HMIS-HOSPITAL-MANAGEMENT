<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_charges', function (Blueprint $table) {
            $table->id();
            $table->string('case_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('section')->nullable();
            $table->string('opd_id')->nullable();
            $table->string('emg_id')->nullable();
            $table->string('ipd_id')->nullable();
            $table->string('charges_date')->nullable();
            $table->string('charge_set')->nullable();
            $table->string('charge_type')->nullable();
            $table->string('charge_category')->nullable();
            $table->string('charge_sub_category')->nullable();
            $table->string('charge_name')->nullable();
            $table->string('standard_charges')->nullable();
            $table->string('qty')->nullable();
            $table->string('tax')->nullable();
            $table->string('amount')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('billing_status')->nullable();
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
        Schema::dropIfExists('patient_charges');
    }
}
