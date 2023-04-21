<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('bill_prefix');
            $table->string('bill_date');
            $table->string('patient_id');
            $table->string('section');
            $table->string('case_id');
            $table->string('opd_id')->nullable();
            $table->string('emg_id')->nullable();
            $table->string('ipd_id')->nullable();
            $table->string('total_amount');
            $table->string('tax')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->nullable();
            $table->string('is_delete')->default(0);
            $table->string('created_by');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('billings');
    }
}
