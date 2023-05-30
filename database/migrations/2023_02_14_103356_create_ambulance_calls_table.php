<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulanceCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulance_calls', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_model')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('start_date_and_time')->nullable();
            $table->string('return_date_and_time')->nullable();
            $table->string('place')->nullable();
            $table->string('purpose')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('ambulance_calls');
    }
}
