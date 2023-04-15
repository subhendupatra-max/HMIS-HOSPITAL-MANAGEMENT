<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_requisition_details', function (Blueprint $table) {
            $table->id();
            $table->integer('requisition_id');
            $table->string('item_id');
            $table->string('unit_id');
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
        Schema::dropIfExists('inventory_requisition_details');
    }
}
