<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('year_made')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('driver_contact')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('ambulances');
    }
}
