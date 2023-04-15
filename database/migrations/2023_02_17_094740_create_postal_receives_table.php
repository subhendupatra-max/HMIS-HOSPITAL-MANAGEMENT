<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_receives', function (Blueprint $table) {
            $table->id();
            $table->string('from_title')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->string('to_title')->nullable();
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
        Schema::dropIfExists('postal_receives');
    }
}
