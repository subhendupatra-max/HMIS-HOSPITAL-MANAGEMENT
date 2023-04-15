<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineStoreRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_store_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('address');
            $table->longText('desc');
            $table->enum('is_active', [0, 1])->default('1')->comment('0->inactive 1->active');
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
        Schema::dropIfExists('medicine_store_rooms');
    }
}
