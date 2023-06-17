<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('req_id');
            $table->string('po_prefix')->nullable();
            $table->string('stock_room_id')->nullable();
            $table->string('po_date')->nullable();
            $table->string('vendor')->nullable();
            $table->string('total')->nullable();
            $table->string('extra_charges_name')->nullable();
            $table->string('extra_charges_value')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('note')->nullable();
            $table->string('feedback')->nullable();
            $table->string('expected_delivery_date')->nullable();
            $table->string('status')->nullable();
            $table->string('grm_status')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('purpose')->nullable();
            $table->string('payment_terms')->nullable();
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
        Schema::dropIfExists('inventory_purchase_orders');
    }
}
