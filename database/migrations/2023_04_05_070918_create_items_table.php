<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->unsignedBigInteger('item_type_id')->nullable();
            $table->unsignedBigInteger('item_catagory_id')->nullable();
            $table->string('item_description');
            $table->longText('stored');
            $table->longText('uses');
            $table->unsignedBigInteger('part_no')->nullable();
            $table->string('item_picture');
            $table->string('hsn_or_sac_no');
            $table->string('loworder_level', 255);
            $table->string('product_code', 255)->nullable();
            $table->string('brand_id')->nullable();
            $table->string('manufacturer')->nullable();
            $table->enum('is_active', [0, 1])->default(1)->comment('1->active, 0->inactive');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
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
        Schema::dropIfExists('items');
    }
}
