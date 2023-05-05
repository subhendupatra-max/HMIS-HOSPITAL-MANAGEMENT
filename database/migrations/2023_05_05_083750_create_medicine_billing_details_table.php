<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_billing_id')->nullable();
            $table->string('medicine_category')->nullable();
            $table->string('medicine_name')->nullable();
            $table->string('medicine_batch')->nullable();
            $table->string('medicine_expiry_date')->nullable();
            $table->string('mrp')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('qty')->nullable();
            $table->string('unit_id')->nullable();
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
        Schema::dropIfExists('medicine_billing_details');
    }
}
