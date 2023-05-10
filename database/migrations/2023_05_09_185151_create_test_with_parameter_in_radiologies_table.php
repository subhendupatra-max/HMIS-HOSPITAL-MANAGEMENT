<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestWithParameterInRadiologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_with_parameter_in_radiologies', function (Blueprint $table) {
            $table->id();
            $table->integer('radiology_test_id');
            $table->integer('radiology_parameter_id');
            $table->longText('reference_range')->nullable();
            $table->longText('unit')->nullable();
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
        Schema::dropIfExists('test_with_parameter_in_radiologies');
    }
}
