<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryReturnItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_return_item_details', function (Blueprint $table) {
            $table->id();
            $table->string('return_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('manufacturer_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('gst')->nullable();
            $table->string('rate')->nullable();
            $table->string('amount')->nullable();
            $table->string('req_id')->nullable();
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
        Schema::dropIfExists('inventory_return_item_details');
    }
}
