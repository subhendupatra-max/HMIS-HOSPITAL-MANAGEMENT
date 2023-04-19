<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesWithBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges_with_billings', function (Blueprint $table) {
            $table->id();
            $table->string('charge_id');
            $table->string('charge_category')->nullable();
            $table->string('charge_sub_category')->nullable();
            $table->string('charge_type')->nullable();
            $table->string('charge_set')->nullable();
            $table->string('charge_amount');
            $table->string('tax');
            $table->string('amount');
            $table->string('billing_id')->nullable();
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
        Schema::dropIfExists('charges_with_billings');
    }
}
