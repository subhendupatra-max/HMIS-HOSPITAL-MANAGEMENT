<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('req_id');
            $table->string('po_prefix');
            $table->string('store_room_id');
            $table->string('po_date');
            $table->string('vendor');
            $table->string('total');
            $table->string('extra_charges_name');
            $table->string('extra_charges_value');
            $table->string('grand_total');
            $table->string('note');
            $table->string('feedback');
            $table->string('expected_delivery_date');
            $table->string('status');
            $table->string('grm_status');
            $table->string('generated_by');
            $table->string('is_delete');
            $table->string('purpose');
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
        Schema::dropIfExists('purchase_orders');
    }
}
