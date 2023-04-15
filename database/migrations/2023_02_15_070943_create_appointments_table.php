<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('doctor')->nullable();
            $table->string('doctor_fees')->nullable();
            $table->string('shift')->nullable();
            $table->string('appointment_date')->nullable();
            $table->string('slot')->nullable();
            $table->string('appointment_priority')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->string('live_consultant')->nullable(); 
            $table->string('alternate_address')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
