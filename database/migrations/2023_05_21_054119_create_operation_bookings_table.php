<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('operation_date_from')->nullable();
            $table->string('operation_date_to')->nullable();
            $table->string('consultant_doctor')->nullable();
            $table->string('ass_consultant_1')->nullable();
            $table->string('ass_consultant_2')->nullable();
            $table->string('anesthetist')->nullable();
            $table->string('anaethesia_type')->nullable();
            $table->string('ot_technician')->nullable();
            $table->string('ot_assistant')->nullable();
            $table->string('remark')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('ins_by')->default('ori');
            $table->string('status')->default('1');
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
        Schema::dropIfExists('operation_bookings');
    }
}
