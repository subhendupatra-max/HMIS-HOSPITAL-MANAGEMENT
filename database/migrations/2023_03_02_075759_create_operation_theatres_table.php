<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationTheatresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_theatres', function (Blueprint $table) {
            $table->id();
            $table->string('ipd_details_id');
            $table->string('operation_department');
            $table->string('operation_catagory');
            $table->string('operation_type');
            $table->string('operation_name');
            $table->string('operation_date');
            $table->string('consultant_doctor');
            $table->string('ass_consultant_1');
            $table->string('ass_consultant_2');
            $table->string('medicine_name');
            $table->string('anesthetist');
            $table->string('anaethesia_type');
            $table->string('ot_technician');
            $table->string('ot_assistant');
            $table->string('remark');
            $table->string('generated_by');
            $table->string('ins_by')->default('ori');
            $table->string('is_delete')->default('0');
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('operation_theatres');
    }
}
