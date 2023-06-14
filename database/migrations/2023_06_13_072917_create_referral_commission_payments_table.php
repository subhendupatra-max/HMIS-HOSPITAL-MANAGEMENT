<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralCommissionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_commission_payments', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('patient_details')->nullable();
            $table->string('bill_id')->nullable();
            $table->string('bill_amount')->nullable();
            $table->string('commission_amount')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('referral_commission_payments');
    }
}
