<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_bills', function (Blueprint $table) {
            $table->id();
            $table->string('section')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('bill_date')->nullable();
            $table->string('case_id')->nullable();
            $table->string('opd_id')->nullable();
            $table->string('emg_id')->nullable();
            $table->string('ipd_id')->nullable();
            $table->string('total')->nullable();
            $table->string('bill_status')->nullable();
            $table->string('payment_status')->nullable()->default('pending');
            $table->string('status')->nullable();
            $table->longText('note')->nullable()->default('');
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
        Schema::dropIfExists('medicine_bills');
    }
}
