<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGRNSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_r_n_s', function (Blueprint $table) {
            $table->id();
            $table->string('grm_prefix')->nullable();
            $table->string('po_no')->nullable();
            $table->string('storeroom_id')->nullable();
            $table->string('vendor')->nullable();
            $table->string('grm_date')->nullable();
            $table->string('medicine_rec_date')->nullable();
            $table->string('bill_rec_date')->nullable();
            $table->string('challan_no')->nullable();
            $table->string('challan_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->string('stock_update_status')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('is_delete')->nullable();
            $table->string('total_sgst_amount')->nullable();
            $table->string('total_igst_amount')->nullable();
            $table->string('total_cgst_amount')->nullable();
            $table->string('total_value')->nullable();
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
        Schema::dropIfExists('g_r_n_s');
    }
}
