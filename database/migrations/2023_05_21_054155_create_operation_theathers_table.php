<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationTheathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_theathers', function (Blueprint $table) {
            $table->id();
            $table->string('operation_booking_id')->nullable();
            $table->string('case_id')->nullable();
            $table->string('section')->nullable();
            $table->string('opd_id')->nullable();
            $table->string('emg_id')->nullable();
            $table->string('ipd_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('operation_department')->nullable();
            $table->string('operation_category_id')->nullable();
            $table->string('operation_id')->nullable();
            $table->string('operation_type')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('operation_theathers');
    }
}
