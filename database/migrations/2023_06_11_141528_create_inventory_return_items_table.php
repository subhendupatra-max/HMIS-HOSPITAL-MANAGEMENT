<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_return_items', function (Blueprint $table) {
            $table->id();
            $table->string('return_prefix')->nullable();
            $table->string('po_no')->nullable();
            $table->string('workshop_id')->nullable();
            $table->string('vendor')->nullable();
            $table->string('rejection_date')->nullable();
            $table->string('material_rec_date')->nullable();
            $table->string('bill_rec_date')->nullable();
            $table->string('challan_no')->nullable();
            $table->string('challan_copy')->nullable();
            $table->string('challan_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_copy')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('po_value')->nullable();
            $table->string('purpose')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('is_delete')->nullable();
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
        Schema::dropIfExists('inventory_return_items');
    }
}
