<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientOthersBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_others_billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('others_billing_id')->nullable();
            $table->string('type')->nullable();
            $table->string('others_category')->nullable();
            $table->string('others_name')->nullable();
            $table->string('charge_amount')->nullable();
            $table->string('qty')->nullable();
            $table->string('tax')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('patient_others_billing_details');
    }
}
