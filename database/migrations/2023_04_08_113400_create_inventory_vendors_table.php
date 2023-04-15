<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('email');
            $table->bigInteger('vendor_ph_no');
            $table->bigInteger('pin');
            $table->bigInteger('vendor_gst');
            $table->string('contact_name')->nullable();
            $table->string('vendor_address');
            $table->enum('is_active', [0, 1])->default(1)->comment('0->inactive 1->active');
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
        Schema::dropIfExists('inventory_vendors');
    }
}
