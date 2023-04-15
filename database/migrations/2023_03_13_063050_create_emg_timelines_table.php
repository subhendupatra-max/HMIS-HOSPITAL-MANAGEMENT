<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmgTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emg_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('emg_id');
            $table->dateTime('date')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('emg_timelines');
    }
}
