<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_medicines', function (Blueprint $table) {
            $table->id();
            $table->string('issue_medicine_master_id')->nullable();
            $table->string('medicine_category')->nullable();
            $table->string('medicine_name')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('quantity')->nullable();
            $table->string('mrp')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('issue_medicines');
    }
}
