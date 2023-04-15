<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_prefix');
            $table->string('store_room_id');
            $table->dateTime('date');
            $table->string('genarated_by');
            $table->string('status');
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
        Schema::dropIfExists('medicine_requisitions');
    }
}
