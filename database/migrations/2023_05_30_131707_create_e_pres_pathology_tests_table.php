<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEPresPathologyTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_pres_pathology_tests', function (Blueprint $table) {
            $table->id();
            $table->string('e_prescriptions_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('case_id')->nullable();
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
        Schema::dropIfExists('e_pres_pathology_tests');
    }
}
