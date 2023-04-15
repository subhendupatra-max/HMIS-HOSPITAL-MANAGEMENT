<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryVendorPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_vendor_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('req_id');
            $table->integer('user_id');
            $table->string('status');
            $table->string('permission_type');
            $table->longText('comment');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_vendor_permissions');
    }
}
