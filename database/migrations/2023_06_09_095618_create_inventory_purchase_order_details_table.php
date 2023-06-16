<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('manufacturer_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('gst')->nullable();
            $table->string('rate')->nullable();
            $table->string('amount')->nullable();
            $table->string('req_id')->nullable();
            $table->string('req_no')->nullable();
            $table->string('grm_status')->default(0);
            $table->string('grm_qty')->default(0);
            $table->string('return_item')->default(0);
            $table->string('req_details_id')->nullable();
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
        Schema::dropIfExists('inventory_purchase_order_details');
    }
}
