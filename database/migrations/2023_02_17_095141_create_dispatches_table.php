<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
             $table->string('to_title')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->string('from_title')->nullable();
            $table->date('date')->nullable();
            $table->string('attach_document')->nullable();
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
        Schema::dropIfExists('dispatches');
    }
}
