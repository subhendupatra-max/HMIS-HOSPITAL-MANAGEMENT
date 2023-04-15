<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloods', function (Blueprint $table) {
            $table->id();
            $table->string('blood_group_id');
            $table->string('blood_donor_id');
            $table->string('donate_date');
            $table->string('bag');
            $table->string('volume');
            $table->string('unit_type');
            $table->string('lot');
            $table->string('charge_catagory_id');
            $table->string('charge_name');
            $table->string('standard_charge');
            $table->string('total');
            $table->string('discount');
            $table->string('tax');
            $table->string('net_amount');
            $table->string('payment_mode');
            $table->string('payment_amount');
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
        Schema::dropIfExists('bloods');
    }
}
