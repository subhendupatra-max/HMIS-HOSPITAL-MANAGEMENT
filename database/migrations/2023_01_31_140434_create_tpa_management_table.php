<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpaManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tpa_management', function (Blueprint $table) {
            $table->id();
            $table->string('TPA_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_ph_no')->nullable();
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
        Schema::dropIfExists('tpa_management');
    }
}
