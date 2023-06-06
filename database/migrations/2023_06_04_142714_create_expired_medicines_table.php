<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpiredMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expired_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('stored_room')->nullable();
            $table->string('status')->nullable();
            $table->string('medicine')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('qty')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('expired_medicines');
    }
}
