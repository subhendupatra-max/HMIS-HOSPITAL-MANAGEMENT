<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_issues', function (Blueprint $table) {
            $table->id();
            $table->string('req_id')->nullable();
            $table->string('issue_prefix')->nullable();
            $table->string('stock_room_id')->nullable();
            $table->string('issued_by')->nullable();
            $table->string('issued_to')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('total')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('note')->nullable();
            $table->string('is_delete')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('inventory_item_issues');
    }
}
