<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('case_id');
            $table->string('opd_id');
            $table->string('emg_id');
            $table->string('ipd_id');
            $table->string('section');
            $table->string('payment_prefix');
            $table->string('payment_amount');
            $table->string('payment_date');
            $table->string('payment_recived_by');
            $table->string('payment_mode');
            $table->longText('note');
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
        Schema::dropIfExists('payments');
    }
}
