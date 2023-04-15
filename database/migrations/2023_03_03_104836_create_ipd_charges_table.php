<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpdChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipd_charges', function (Blueprint $table) {
            $table->id();
            $table->string('ipd_id');
            $table->string('charge_type_id');
            $table->string('charge_catagory_id');
            $table->string('charge_name');
            $table->string('standard_charges');
            $table->string('tpa_charge');
            $table->string('qty');
            $table->string('total');
            $table->string('tax');
            $table->string('net_amount');
            $table->string('charge_note');
            $table->string('date');
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
        Schema::dropIfExists('ipd_charges');
    }
}
