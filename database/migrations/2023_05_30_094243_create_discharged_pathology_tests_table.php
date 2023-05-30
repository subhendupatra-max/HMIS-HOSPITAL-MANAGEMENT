<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDischargedPathologyTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharged_pathology_tests', function (Blueprint $table) {
            $table->id();
            $table->string('ipd_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('case_id')->nullable();
            $table->string('discharged_id')->nullable();
            $table->string('test_id')->nullable();
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
        Schema::dropIfExists('discharged_pathology_tests');
    }
}
