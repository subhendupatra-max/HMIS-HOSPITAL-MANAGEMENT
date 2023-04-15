<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGRNDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_r_n_details', function (Blueprint $table) {
            $table->id();
            $table->string('grm_id');
            $table->string('medicine_id');
            $table->string('unit_id');
            $table->string('catagory_id');
            $table->string('quantity');
            $table->string('gst');
            $table->string('rate');
            $table->string('amount');
            $table->string('req_id');
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
        Schema::dropIfExists('g_r_n_details');
    }
}
