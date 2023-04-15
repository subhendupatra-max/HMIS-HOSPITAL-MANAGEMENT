<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('doctor')->nullable();
            $table->string('day')->nullable();
            $table->string('shift')->nullable();
            $table->string('consultation_duration')->nullable();
            $table->string('charge_category')->nullable();
            $table->string('charge_sub_category')->nullable();
            $table->string('charge')->nullable();
            $table->string('amount')->nullable();
            $table->string('from_time')->nullable();
            $table->string('to_time')->nullable();
            $table->string('tax')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('standard_charges')->nullable();
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
        Schema::dropIfExists('slots');
    }
}
