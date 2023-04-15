<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_requisition_details', function (Blueprint $table) {
            $table->id();
            $table->integer('requisition_id');
            $table->string('medicine_catagory');
            $table->string('medicine_name');
            $table->string('medicine_unit');
            $table->string('quantity');
            $table->string('po_status');
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
        Schema::dropIfExists('medicine_requisition_details');
    }
}
