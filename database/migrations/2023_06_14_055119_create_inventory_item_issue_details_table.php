<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_issue_details', function (Blueprint $table) {
            $table->id();
            $table->string('issue_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('manufacturar_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('quantity')->nullable();
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
        Schema::dropIfExists('inventory_item_issue_details');
    }
}
