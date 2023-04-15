<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPermissionAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_permission_authorities', function (Blueprint $table) {
            $table->id();
            $table->integer('requisition_id');
            $table->string('need_permission');
            $table->string('user_id');
            $table->string('permission_type');
            $table->string('status');
            $table->string('date');
            $table->string('comment');
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
        Schema::dropIfExists('inventory_permission_authorities');
    }
}
