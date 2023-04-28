<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('grn_id')->nullable();
            $table->string('emg_challan_id')->nullable();
            $table->string('stored_room')->nullable();
            $table->string('stock_status')->nullable();
            $table->string('medicine_category')->nullable();
            $table->string('medicine_name')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('quantity')->nullable();
            $table->string('mrp')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('purchase_price')->nullable();
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
        Schema::dropIfExists('medicine_stocks');
    }
}
