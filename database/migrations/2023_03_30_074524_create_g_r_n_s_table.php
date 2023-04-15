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
            $table->string('grm_prefix');
            $table->string('po_no');
            $table->string('storeroom_id');
            $table->string('vendor');
            $table->string('grm_date');
            $table->string('medicine_rec_date');
            $table->string('bill_rec_date');
            $table->string('challan_no');
            $table->string('challan_copy');
            $table->string('challan_date');
            $table->string('invoice_no');
            $table->string('invoice_copy');
            $table->string('invoice_date');
            $table->string('invoice_value');
            $table->string('po_value');
            $table->string('purpose');
            $table->string('purpose_grm');
            $table->string('note');
            $table->string('status');
            $table->string('stock_update_status');
            $table->string('generated_by');
            $table->string('is_delete');
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
