<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('grn_id');
            $table->string('storeroom_id');
            $table->string('medicine_id');
            $table->string('medicine_unit_id');
            $table->string('medicine_catagory_id');
            $table->string('quantity');
            $table->string('gst');
            $table->string('rate');
            $table->string('status');
            $table->string('amount');
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
        Schema::dropIfExists('item_stocks');
    }
}
