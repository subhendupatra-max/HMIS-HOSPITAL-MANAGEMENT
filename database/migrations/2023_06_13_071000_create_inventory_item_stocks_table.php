<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('grm_id')->nullable();
            $table->string('workshop_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('manufacturer_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('gst')->nullable();
            $table->string('rate')->nullable();
            $table->string('status')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('inventory_item_stocks');
    }
}
