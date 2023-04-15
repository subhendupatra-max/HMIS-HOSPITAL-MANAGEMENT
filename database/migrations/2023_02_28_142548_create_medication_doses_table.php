<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationDosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_doses', function (Blueprint $table) {
            $table->id();
            $table->string('ipd_id');
            $table->date('date');
            $table->time('time');
            $table->string('medicine_catagory_id');
            $table->string('medicine_name');
            $table->string('dosage');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('medication_doses');
    }
}
