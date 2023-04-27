<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_bill_id', 255);
            $table->string('medicine_category_id', 255);
            $table->string('medicine_id', 255);
            $table->string('medicine_batch', 255);
            $table->string('medicine_expiry_date', 255);
            $table->string('mrp', 255);
            $table->string('sale_price', 255);
            $table->string('qty', 255);
            $table->string('unit_id', 255);
            $table->string('tax', 255);
            $table->string('amount', 255);
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
        Schema::dropIfExists('medicine_bill_details');
    }
}
