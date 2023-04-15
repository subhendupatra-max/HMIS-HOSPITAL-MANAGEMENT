<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_prefix');
            $table->string('stock_room');
            $table->dateTime('date');
            $table->string('genarated_by');
            $table->string('checked_by');
            $table->string('requested_by');
            $table->string('status');
            $table->string('po_status');
            $table->string('is_delete');
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
        Schema::dropIfExists('inventory_requisitions');
    }
}
