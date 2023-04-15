<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpdDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_details', function (Blueprint $table) {
            $table->id();
            $table->string('case_id');
            $table->string('patient_id');
            $table->string('generate_by');
            $table->string('opd_prefix');
            $table->integer('is_ipd_moved')->default(0);
            $table->string('ins_by')->default('ori');
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
        Schema::dropIfExists('opd_details');
    }
}
