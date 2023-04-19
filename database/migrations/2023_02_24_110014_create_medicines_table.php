<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name');
            $table->string('medicine_catagory');
            $table->string('medicine_company')->nullable();
            $table->string('medicine_composition')->nullable();
            $table->string('medicine_group')->nullable();
            $table->string('unit')->nullable();
            $table->string('min_level')->nullable();
            $table->string('unit')->nullable();
            $table->string('tax')->nullable();
            $table->string('note')->nullable();
            $table->string('medicine_photo')->nullable();
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
        Schema::dropIfExists('medicines');
    }
}
