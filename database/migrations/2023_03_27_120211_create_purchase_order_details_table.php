<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_order_id');
            $table->string('medicine_catagory_id');
            $table->string('medicine_unit_id');
            $table->string('medicine_name');
            $table->string('quantity');
            $table->string('gst');
            $table->string('rate');
            $table->string('amount');
            $table->string('req_id');
            $table->string('req_details_id');
            $table->string('req_no');
            $table->string('grm_status');
            $table->string('grm_qty');
            $table->string('return_item');
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
        Schema::dropIfExists('purchase_order_details');
    }
}
